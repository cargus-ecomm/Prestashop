<?php

include_once(_PS_MODULE_DIR_ . '/cargus/cargus.class.php');

use Symfony\Component\HttpFoundation\JsonResponse;

class CargusLocationModuleFrontController extends ModuleFrontController
{
    /**
     * CargusAdminController constructor.
     * @throws PrestaShopException
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function init()
    {
        parent::init();
    }

    public function initContent()
    {
        parent::initContent();

        try {
            $json = file_get_contents('php://input');

            $data = json_decode($json, true);

            if (isset($data['location_id'])) {
                $locationId = $data['location_id'];

                $cart = $this->context->cart;

                Db::getInstance()->execute('
            UPDATE `' . _DB_PREFIX_ . 'cart`
            SET `pudo_location_id` = ' . (int)$locationId . '
            WHERE `id_cart` = ' . $cart->id
                );
            } else {
                echo 'ERROR: There was a problem saving the Ship & Go Location';
            }

            echo 'OK!';
        } catch (\Exception $e) {
            echo 'ERROR: There was a problem saving the Ship & Go Location';
        }

    }
}