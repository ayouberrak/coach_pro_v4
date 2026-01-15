<?php


namespace App\Services;

use App\Repository\SportifRepository;
use Exception;


class SportifServices {

    private SportifRepository $sportifRepository;

    public function __construct() {
        $this->sportifRepository = new SportifRepository();
    }

    public function getInfoClientById(int $id_client) {
        try {
            return $this->sportifRepository->getInfoClientById($id_client);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve client info: " . $e->getMessage());
        }
    }

}