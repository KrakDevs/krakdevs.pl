<?php

namespace KrakDevs\WebBundle\Admin;

use FSi\Bundle\AdminBundle\Doctrine\Admin\CRUDElement;
use FSi\Component\DataGrid\DataGridFactoryInterface;
use FSi\Component\DataSource\DataSourceFactoryInterface;
use FSi\Component\DataSource\Driver\Collection\Extension\Core\Field\DateTime;
use Symfony\Component\Form\FormFactoryInterface;

class Event extends CRUDElement
{
    public function getClassName()
    {
        return 'KrakDevs\WebBundle\Entity\Event';
    }

    public function getId()
    {
        return 'event';
    }

    public function getName()
    {
        return 'admin.event.name';
    }

    protected function initDataGrid(DataGridFactoryInterface $factory)
    {
        return $factory->createDataGrid('admin_event');
    }

    protected function initDataSource(DataSourceFactoryInterface $factory)
    {
        $datasource = $factory->createDataSource(
            'doctrine-orm',
            array('qb' => $this->getRepository()->createListQueryBuilder()),
            'admin_event'
        );
        $datasource->setMaxResults(20);

        return $datasource;
    }

    protected function initForm(FormFactoryInterface $factory, $data = null)
    {
        $form = $factory->create('form', $data, array(
            'data_class' => $this->getClassName()
        ));

        $form->add('title', 'text', array('label' => 'admin.event.title'));
        $form->add('date', 'datetime', array(
            'label' => 'admin.event.datetime',
            'date_widget' => 'single_text',
            'time_widget' => 'choice',
            'empty_data' => new \DateTime(date("Y-m-d 19:00"))
        ));
        $form->add('eventMaster', 'entity', array(
            'class' => 'KrakDevs\WebBundle\Entity\User',
            'label' => 'admin.event.event_master',
            'empty_value' => 'admin.event.choose_event_master'
        ));

        $form->add('locationName', 'text', array('label' => 'admin.event.location_name'));
        $form->add('locationUrl', 'url', array('label' => 'admin.event.location_url'));
        $form->add('description', 'fsi_ckeditor', array('label' => 'admin.event.description'));

        return $form;
    }
}
