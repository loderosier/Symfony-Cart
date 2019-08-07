<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Payment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadCategories($manager);
        $this->loadProducts($manager);
        $this->loadPayments($manager);
    }

    private function loadProducts(ObjectManager $manager): void
    {
        foreach ($this->getProductsData() as [$name, $image, $price, $category]) {
            $product = new Product();
            $product->setCreatedAt(new \DateTime('NOW'));
            $product->setUpdatedAt(new \DateTime('NOW'));
            $product->setName($name);
            $product->setImage($image);
            $product->setPrice($price);
            $product->setCategory($this->getReference($category));

            $manager->persist($product);
        }
        $manager->flush();
    }

    private function loadCategories(ObjectManager $manager) :void
    {
        foreach ($this->getCategoriesData() as [$name]) {
            $category = new Category();
            $category->setName($name);

            $this->addReference($name, $category);

            $manager->persist($category);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private function getCategoriesData(): array
    {
        return [
            // $categoriesData = [$name];
            [
                'PC Games',
            ],
            [
                'Accessories',

            ],
            [
                'PS Games',
            ]
        ];
    }

    /**
     * @return array
     */
    private function getProductsData(): array
    {
        return [
            // $productData = [$name, $image, $price, $category];
            [
                'Headphones',
                null,
                150,
                "Accessories"
            ],
            [
                'Bloody Mouse',
                null,
                3799,
                "Accessories"
            ],
            [
                'Bloody Mouse Pad',
                null,
                2499,
                "Accessories"
            ],
            [
                'PC game name',
                null,
                50,
                "PC Games"
            ], [
                'PS game name',
                null,
                120,
                "PS Games"
            ]
        ];
    }
    private function loadPayments(ObjectManager $manager): void
    {
        foreach ($this->getPaymentsData() as [$name, $price]) {
            $payment = new Payment();
            $payment->setCreatedAt(new \DateTime('NOW'));
            $payment->setUpdatedAt(new \DateTime('NOW'));
            $payment->setName($name);
            $payment->setPrice($price);

            $manager->persist($payment);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private function getPaymentsData(): array
    {
        return [
            // $paymentData = [$name, $price];
            [
                'Payment 1',
                0
            ],
            [
                'Payment 2',
                5
            ],
            [
                'Payment 3',
                1.23
            ]
        ];
    }
}
