<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Exception;

/**
 * Class PhoneManager.
 */
class PhoneManager
{
    /**
     * A PhoneRepository Instance.
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
     * Retrieve all phones from db and paginates the list.
     *
     * @param int|null $page
     *
     * @return Phone[]
     *
     * @throws Exception
     */
    public function findAllPhone(?int $page): array
    {
        if (null === $page || $page < 1) {
            $page = 1;
        }

        $limit = 3;

        $data = $this->phoneRepository->findAllPhones($page, $limit);

        return $data->getIterator()->getArrayCopy();
    }
}
