<?php

namespace NW\WebService\References\Operations\Notification;

/**
 * @property Seller $Seller
 */
class Contractor
{
    const TYPE_CUSTOMER = 0;
    public $id;
    public $type;
    public $name;

    public function __construct(int $id)
    {
        $this->id = $id;
        // Инициализация других свойств, если необходимо
    }

    public static function getById(int $resellerId): self
    {
        return new self($resellerId); // теперь метод работает корректно
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->id;
    }
}

class Seller extends Contractor
{
    // Наследует свойства и методы от Contractor
}

class Employee extends Contractor
{
    // Наследует свойства и методы от Contractor
}

class Status
{
    public $id, $name;

    public static function getName(int $id): string
    {
        $a = [
            0 => 'Completed',
            1 => 'Pending',
            2 => 'Rejected',
        ];

        return $a[$id];
    }
}

abstract class ReferencesOperation
{
    abstract public function doOperation(): array;

    public function getRequest($pName)
    {
        return $_REQUEST[$pName];
    }
}

function getResellerEmailFrom()
{
    return 'contractor@example.com';
}

function getEmailsByPermit($resellerId, $event)
{
    // фейковый метод
    return ['someemeil@example.com', 'someemeil2@example.com'];
}

class NotificationEvents
{
    const CHANGE_RETURN_STATUS = 'changeReturnStatus';
    const NEW_RETURN_STATUS    = 'newReturnStatus';
}
//Ошибка  заключается в том, что метод getById класса Contractor пытается создать новый объект с использованием конструктора, который не принимает аргументы. 
//Однако, в коде конструктор класса Contractor не определён, и по умолчанию PHP создаёт конструктор без аргументов. 
//Чтобы исправить это, вам нужно определить конструктор в классе Contractor, который принимает id в качестве аргумента. 
