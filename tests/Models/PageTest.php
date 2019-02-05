<?php

namespace Tests\Model;

use Tests\TestCase;
use App\Models\Page;

class PageTest extends TestCase
{
    private static $model;

    public static function setUpBeforeClass()
    {
        self::$model = Page::getInstance();
    }

    public function testGetPageData09()
    {
        $expected = [
            'offset' => 0,
            'limit' => 2,
            'max_page' => 5,
            'current_page' => 1,
            'start_page' => 1,
            'page_link' => 3,
        ];

        self::$model->setPageUnit(2);
        self::$model->setDefaultPage(1);
        self::$model->setPageLink(3);

        $this->assertEquals($expected, self::$model->getPageData(0, 9));
    }

    public function testGetPageDataNull9()
    {
        $expected = [
            'offset' => 0,
            'limit' => 2,
            'max_page' => 5,
            'current_page' => 1,
            'start_page' => 1,
            'page_link' => 3,
        ];

        self::$model->setPageUnit(2);
        self::$model->setDefaultPage(1);
        self::$model->setPageLink(3);

        $this->assertEquals($expected, self::$model->getPageData(null, 9));
    }

    public function testGetPageData39()
    {
        $expected = [
            'offset' => 4,
            'limit' => 2,
            'max_page' => 5,
            'current_page' => 3,
            'start_page' => 2,
            'page_link' => 3,
        ];

        self::$model->setPageUnit(2);
        self::$model->setDefaultPage(1);
        self::$model->setPageLink(3);

        $this->assertEquals($expected, self::$model->getPageData(3, 9));
    }

    public function testGetPageData59()
    {
        $expected = [
            'offset' => 8,
            'limit' => 2,
            'max_page' => 5,
            'current_page' => 5,
            'start_page' => 3,
            'page_link' => 3,
        ];

        self::$model->setPageUnit(2);
        self::$model->setDefaultPage(1);
        self::$model->setPageLink(3);

        $this->assertEquals($expected, self::$model->getPageData(5, 9));
    }

    public function testGetPageData69()
    {
        $expected = [
            'offset' => 0,
            'limit' => 2,
            'max_page' => 5,
            'current_page' => 1,
            'start_page' => 1,
            'page_link' => 3,
        ];

        self::$model->setPageUnit(2);
        self::$model->setDefaultPage(1);
        self::$model->setPageLink(3);

        $this->assertEquals($expected, self::$model->getPageData(6, 9));
    }
}
