<?php
namespace Post2GoClient\Core\RequestParam;

class Tracking implements RequestParamInterface
{
    /**
     * Название посылки
     * @var null|string
     */
    private $title = null;

    /**
     * Идентификатор заказа
     * @var null|string
     */
    private $orderCode = null;

    /**
     * Ссылка на заказ
     * @var null|string
     */
    private $orderUrl = null;

    /**
     * Имя клиента
     * @var null|string
     */
    private $customerName = null;

    /**
     * Массив email адресов
     * @var array
     */
    private $emails = [];

    /**
     * @return null|string
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

    /**
     * @return null|string
     */
    public function getOrderCode()
    {
        return $this->orderCode;
    }

    /**
     * @param null|string $orderCode
     */
    public function setOrderCode($orderCode)
    {
        $this->orderCode = $orderCode;
    }

    /**
     * @return null|string
     */
    public function getOrderUrl()
    {
        return $this->orderUrl;
    }

    /**
     * @param null|string $orderUrl
     */
    public function setOrderUrl($orderUrl)
    {
        $this->orderUrl = $orderUrl;
    }

    /**
     * @return null|string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param null|string $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param array $emails
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    public function toArray()
    {
        $data = array();
        if ($this->getTitle() !== null) {
            $data['title'] = $this->getTitle();
        }
        if ($this->getOrderCode() !== null) {
            $data['orderCode'] = $this->getOrderCode();
        }
        if ($this->getOrderUrl() !== null) {
            $data['orderUrl'] = $this->getOrderUrl();
        }
        if ($this->getCustomerName() !== null) {
            $data['customerName'] = $this->getCustomerName();
        }
        if ($this->getEmails() !== null) {
            $data['emails'] = $this->getEmails();
        }
        return $data;
    }
}
