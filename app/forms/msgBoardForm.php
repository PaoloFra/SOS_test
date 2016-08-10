<?php

namespace Forms;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation\Validator\Regex as RegexValidator;

class msgBoardForm
{

    public function initialize()
    {

    }

    public static function createMsg($r)
    {
        $id = $r->getPost("id", "int")?:0;

        $validation = new Validation();

        $validation->add(
            'name',
            new PresenceOf( [ 'message' => 'Имя - обязательный параметн' ] )
        );

        $validation->add('name', new StringLength(array(
            'max' => 60,
            'min' => 3,
            'messageMaximum' => 'Имя не более 60 символов',
            'messageMinimum' => 'Имя не менее 3-х символов'
        )));

        $validation->add('phone', new RegexValidator(array(
            'pattern' => '/^\(?\d{2}\)?[\-\.\s]?\d{3}[\-\.]\d{3}[\-\.]\d{2}[\-\.]\d{2}$/',
            'message' => 'Формат номера телефона: (38) 044-123-45-67'
        )));

        $validation->add(
            'mail',
            new PresenceOf( [ 'message' => 'The e-mail is required' ] )
        );

        $validation->add(
            'mail',
            new Email( [ 'message' => 'The e-mail is not valid' ]
            )
        );

        $validation->add('message', new StringLength(array(
            'max' => 200,
            'min' => 2,
            'messageMaximum' => 'Макс.длина - 200 символов',
            'messageMinimum' => 'Слишком короткое сообщение'
        )));

        $messages = $validation->validate($r->getPost());
        if (count($messages)) {
            foreach ($messages as $message) {
                return $message;
            }
        }
        //------------------
        if ($id) {
            $newMsg = \Models\MsgBoard::findFirst("id={$id}");
        } else {
            $newMsg = new \Models\MsgBoard();
        }

        $newMsg->name = $r->getPost("name", "string");
        $newMsg->phone = $r->getPost("phone", "float");
        $newMsg->mail = $r->getPost("mail", "email");
        $newMsg->message = $r->getPost("message", "string");
        $newMsg->date = date("Y-m-d H:i:sO");
        //
        $errMsg = '';
        if (!$newMsg->save()) {

            foreach ($newMsg->getMessages() as $message) {
                $errMsg .= (string) $message;
            }
            return $errMsg;

        } else {
            return $newMsg->id;
        }
    }

    public static function removeMsg($id)
    {
        $id = (int) $id;

        $delMsg = \Models\MsgBoard::findFirst('id="' . $id . '"');
        if (!$delMsg) {
            return "Сообщение не найдено!";
        }

        //
        $errMsg = '';
        if (!$delMsg->delete()) {
            foreach ($delMsg->getMessages() as $message) {
                $errMsg .= (string) $message;
            }
            return $errMsg;
        }

        return 'OK';

    }
}
