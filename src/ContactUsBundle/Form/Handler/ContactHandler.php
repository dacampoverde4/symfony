<?php

namespace ContactUsBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

use ContactUsBundle\Entity\Contact;

class ContactHandler
{
    protected $form;
    protected $request;
    protected $em;
    protected $uploadsDirectory;

    public function __construct(Form $form, Request $request, EntityManager $em, String $uploadsDirectory)
	{
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
        $this->uploadsDirectory = $uploadsDirectory;
    }

    public function process()
	{
        if($this->request->isMethod('POST'))
		{
			$this->form->handleRequest($this->request);

            if($this->form->isSubmitted() && $this->form->isValid())
			{
                $this->onSuccess($this->form->getData());

                return true;
            }
        }

        return false;
    }

    public function onSuccess(Contact $contact)
	{
		if($contact->getFilePath1() != null)
		{
			$file = $contact->getFilePath1();
			$fileName = md5(uniqid()).'.'.$file->guessExtension();
			$file->move($this->uploadsDirectory, $fileName);
			$contact->setFilePath1($fileName);
		}

		if($contact->getFilePath2() != null)
		{
			$file = $contact->getFilePath2();
			$fileName = md5(uniqid()).'.'.$file->guessExtension();
			$file->move($this->uploadsDirectory, $fileName);
			$contact->setFilePath2($fileName);
		}

		$this->em->persist($contact);
        $this->em->flush();
    }
}
