<?php
include_once(_PS_MODULE_DIR_ . '/cargus/cargus.class.php');

class CargusCronModuleFrontController extends ModuleFrontController
{
    const FILE_THRESHOLD_SECONDS = 1800; // If file wasn't modified for > 1h (3600s)

    CONST LOCATION_FILE_NAME_TMP = _PS_MODULE_DIR_. '/cargus/assets/locations/pudo_locations_tmp.json';

    CONST LOCATION_FILE_NAME = _PS_MODULE_DIR_. '/cargus/assets/locations/pudo_locations.json';

    /** @var bool If set to true, will be redirected to authentication page */
    public $auth = false;

    /** @var bool */
    public $ajax;

    public function display()
    {
        $isUpdating = Configuration::get('PUDO_LOCATION_UPDATING', $id_lang = null);

        if(!file_exists(self::LOCATION_FILE_NAME) || (time() - filemtime(self::LOCATION_FILE_NAME) >= 1 * self::FILE_THRESHOLD_SECONDS && !$isUpdating)) {
            Configuration::updateValue('PUDO_LOCATION_UPDATING', 1);
            $this->ajax = 1;

        $cargus = new CargusClass(
            Configuration::get('CARGUS_API_URL', $id_lang = null),
            Configuration::get('CARGUS_API_KEY', $id_lang = null)
        );

        $fields = array(
            'UserName' => Configuration::get('CARGUS_USERNAME', $id_lang = null),
            'Password' => Configuration::get('CARGUS_PASSWORD', $id_lang = null)
        );

        $token = $cargus->CallMethod('LoginUser', $fields, 'POST');

        $locations = $cargus->CallMethod('PudoPoints', array(), 'GET', $token);

        $locationsJson = '[';

        file_put_contents(self::LOCATION_FILE_NAME_TMP, $locationsJson, FILE_APPEND);

        $i = 0;
        $len = count($locations);

        foreach($locations as $key => $location) {
            $locationsJson = json_encode($location, JSON_UNESCAPED_SLASHES);
            if ($i != $len - 1) {
                $locationsJson .= ",";
            }

            file_put_contents(self::LOCATION_FILE_NAME_TMP, $locationsJson, FILE_APPEND);

            $i++;
        }

        $locationsJson = ']';
        file_put_contents(self::LOCATION_FILE_NAME_TMP, $locationsJson, FILE_APPEND);

        if (file_exists(self::LOCATION_FILE_NAME)) {
            unlink(self::LOCATION_FILE_NAME);
        }

        rename(self::LOCATION_FILE_NAME_TMP, self::LOCATION_FILE_NAME);

        Configuration::updateValue('PUDO_LOCATION_UPDATING', 0);
        $this->ajaxRender('File updated!');
        } else {
            if ($isUpdating) {
                $this->ajaxRender('File is updating!');
            } else {
                $this->ajaxRender('File was modified in the last 30 min!');
            }
        }
    }
}