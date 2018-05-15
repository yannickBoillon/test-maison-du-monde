<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class CategoryProductList
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var RequestStack */
    private $requestStack;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * CategoryProductList constructor.
     * @param EntityManagerInterface $entityManager
     * @param RequestStack $requestStack
     * @param SerializerInterface $serializer
     */
    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->serializer = $serializer;
    }


    /**
     * @Route(
     *     name="category_products",
     *     path="/categories/{id}/products/",
     *     methods={"GET"}
     * )
     */
    public function __invoke(int $id)
    {
        $page = (int)$this->requestStack->getCurrentRequest()->query->get('page', 0);
        $limit = (int)$this->requestStack->getCurrentRequest()->query->get('limit', 20);

        if ($page > 0) {
            $offset = ($page - 1) * $limit;
        } else {
            $offset = 0;
        }

        $products = $this->entityManager->getRepository(Product::class)
            ->findByCategoryId($id, $limit, $offset);

        $data = $this->serializer->serialize($products, 'json');

        return new JsonResponse(json_decode($data));
    }
}
