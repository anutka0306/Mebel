<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Message;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class MailerController extends AbstractController
{
    private $validatorInterface;

    public function __construct(ValidatorInterface $validatorInterface)
    {
       $this->validatorInterface = $validatorInterface;
    }



    /**
     * @Route("/callback_form", name="callback_form")
     */
    public function callback_form(Request $request, MailerInterface $mailer){
        $to = explode(',',$this->getTo_salonWithout() );
        foreach ($to as $recipient){
            $email = (new Email())
                ->from('robot@mirakpp.ru')
                ->to((string)$recipient)
                ->subject('Новая заявка с сайта Mebel')
                ->html('<p>Новая заявка с сайта Mebel</p>
             <p>Имя отправителя: ' . $request->get('name') . '</p>
            <p>Телефон отправителя: ' . $request->get('phone') . '</p>'
                );
            $mailer->send($email);
        }

        return new JsonResponse(['success'=>'<p>Спасибо! Ваша заявка отправлена.</p>']);
    }


    /**
     * @Route("/contact_form", name="contact_form")
     */
    public function contact_form(Request $request, MailerInterface $mailer){
        $to = explode(',',$this->getTo_salonWithout() );
        foreach ($to as $recipient){
            $email = (new Email())
                ->from('robot@mirakpp.ru')
                ->to((string)$recipient)
                ->subject('Сообщение со страницы Контакты')
                ->html('<p>Сообщение со страницы Контакты</p>
             <p>Email отправителя: ' . $request->get('email') . '</p>
            <p>Сообщение: ' . $request->get('message') . '</p>'
                );
            $mailer->send($email);
        }

        return new JsonResponse(['success'=>'<p>Спасибо! Ваше сообщение отарвлено.</p>']);
    }

    public function addEmail($email, ValidatorInterface $validator){
        $emailConstraint = array(
            new Assert\Email(),
            new Assert\NotBlank(),
        );
        $errors = $validator->validate(
          $email,
          $emailConstraint
        );

        if(0 === count($errors)){
            return true;
        }else{
            return false;
        }
    }

    public function addName($name, ValidatorInterface $validator){
        $nameConstraint = array(
            new Assert\NotBlank(),
            new Assert\Length(['min' => 2]),
            new Assert\Regex(['pattern' => '/^[а-яёА-ЯЁ]+$/'])
        );

        $errors = $validator->validate(
            $name,
            $nameConstraint
        );
        if(0 === count($errors)){
            return true;
        }else{
            return false;
        }
    }

    public function addPhone($phone, ValidatorInterface $validator){
        $phoneConstraint = array(
          new Assert\NotBlank(),
          new Assert\Regex(['pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'])
        );
        $errors = $validator->validate(
            $phone,
            $phoneConstraint
        );
        if(0 === count($errors)){
            return true;
        }else{
            return false;
        }
    }



     public function getTo_salonWithout(){
         /*return 'anya-programmist@qmotors.ru';*/
         return 'zakaz@abugera.ru';
     }

}
