<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Phone;
use App\Repository\PhoneRepository;

/**
 * Class PhoneManager.
 */
class PhoneManager
{
    /**
     * A PhoneRepository Instance
     *
     * @var PhoneRepository
     */
    private $phoneRepository;

    /**
     * PhoneManager constructor.
     *
     * @param PhoneRepository $phoneRepository
     */
    public function __construct(PhoneRepository $phoneRepository)
    {
        $this->phoneRepository = $phoneRepository;
    }

    /**
     * Retrieve all phones from db
     *
     * @return Phone[]
     */
    public function findAllPhone(): array
    {
        return $this->phoneRepository->findAll();
    }

    /**
     * Retrieve a phone from db
     *
     * @param Int $id
     *
     * @return Phone|null
     */
    public function findPhone(Int $id): ?Phone
    {
        return $this->phoneRepository->find($id);
    }
}
