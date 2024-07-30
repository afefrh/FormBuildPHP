<?php

require 'vendor/autoload.php';

use FormBuilder\Form;
use FormBuilder\Input;
use FormBuilder\Textarea;
use FormBuilder\Select;
use FormBuilder\Label;

$form = new Form();
$form->create('/submit', 'post')
    ->addElement((new Label('username', 'Username:'))->attr(['class' => 'form-label']))
    ->addElement((new Input('username', 'text'))->attr(['placeholder' => 'Enter username', 'class' => 'form-input']))
    ->addElement((new Label('password', 'Password:'))->attr(['class' => 'form-label']))
    ->addElement((new Input('password', 'password'))->attr(['placeholder' => 'Enter password', 'class' => 'form-input']))
    ->addElement((new Label('message', 'Message:'))->attr(['class' => 'form-label']))
    ->addElement((new Textarea('message'))->attr(['placeholder' => 'Your message', 'class' => 'form-textarea']))
    ->addElement((new Select('gender', ['m' => 'M', 'f' => 'F']))->attr(['class' => 'form-select']))
    ->addElement((new Input('submit', 'submit'))->attr(['value' => 'Send', 'class' => 'form-button']));

echo $form;
