<?php
namespace ParcelGoClient\Core\RequestParam;

class Tracking implements RequestParamInterface
{
    /**
     * Название посылки
     * @var string
     */
    private $title = null;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function toArray()
    {
        $data = array();
        if ($this->getTitle() !== null) {
            $data['title'] = $this->getTitle();
        }
        return $data;
    }


}