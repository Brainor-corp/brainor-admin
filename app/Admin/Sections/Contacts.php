<?php

namespace App\Admin\Sections;

use App\User;
use Bradmin\Section;
use Bradmin\SectionBuilder\Display\BaseDisplay\Display;
use Bradmin\SectionBuilder\Display\Table\Columns\BaseColumn\Column;
use Bradmin\SectionBuilder\Form\BaseForm\Form;
use Bradmin\SectionBuilder\Form\Panel\Columns\BaseColumn\FormColumn;
use Bradmin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;

class Contacts extends Section
{
    public static function onDisplay(){
        $display = Display::table([
            Column::text('id', '#'),
            Column::text('value', 'Значение'),
            Column::text('created_at', 'Дата добавления'),
            Column::text('user.name', 'Пользователь'),
        ])->setPagination(10);

        return $display;
    }

    public static function onCreate()
    {
        return self::onEdit();
    }

    public static function onEdit()
    {
        $form = Form::panel([
            FormColumn::column([
                FormField::input('value', 'Значение')->setRequired(true),
                FormField::select('user_id', 'Пользователь')
                    ->setModelForOptions(User::class)
                    ->setDisplay('name')
                    ->setRequired(true)
            ]),
        ]);

        return $form;
    }
}