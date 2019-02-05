<?php

namespace App\Models;

class Page
{

    use BaseTrait;

    private $page_unit = 2;// １ページに表示する件数
    private $default_page = 1;// 最初のページ
    private $page_link = 5;// ページネーションのリンクを表示する件数(中央をアクティブにしたいので奇数)

    public function setPageUnit(int $number)
    {
        $this->page_unit = $number;
    }

    public function setDefaultPage(int $number)
    {
        $this->default_page = $number;
    }

    public function setPageLink(int $number)
    {
        $this->page_link = $number;
    }

    /**
     * ページネーションの表示に必要な情報の取得
     * これで取得したoffsetとlimitで表示するアイテムのリストは別途取得すること
     *
     * @param int $page ページ位置（クエリーストリングから渡ってくる想定）
     * @param int $item_count 全アイテム数
     * @return array
     */
    public function getPageData(int $page = null, int $item_count): array
    {
        $data = [];
        $data['limit'] = $this->page_unit;
        $data['max_page'] = (int)(($item_count - 1) / $this->page_unit) + 1;

        if (is_null($page) || $page === 0 || $data['max_page'] < $page)
        {
            $data['current_page'] = $this->default_page;
            $data['offset'] = 0;
        }
        else
        {
            $data['current_page'] = $page;
            $data['offset'] = ($page - 1) * $this->page_unit;
        }

        $data['page_link'] = $this->page_link;
        if ($data['current_page'] < $data['max_page'] - (int)($data['page_link'] / 2))
        {
            $start_number = $data['current_page'] - (int)($data['page_link'] / 2);
        }
        else
        {
            $start_number = $data['max_page'] - $data['page_link'] + 1;
        }
        $data['start_page'] = $start_number < $this->default_page ? $this->default_page : $start_number;
        
        $data['pre_page'] = $data['start_page'] > 1 ? $data['start_page'] - 1 : null;
        $end_number = $data['start_page'] + $data['page_link'] - 1;
        $data['next_page'] = $end_number < $data['max_page'] ? $end_number + 1 : null;

        return $data;
    }

}