<?php

namespace ContactUsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GenesisGlobal\Salesforce\SalesforceBundle\Sobject\Sobject;

use ContactUsBundle\Entity\Contact;
use ContactUsBundle\Form\Type\ContactType;
use ContactUsBundle\Form\Handler\ContactHandler;

class PublicController extends Controller
{
    public function indexAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();

		$contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $formHandler = new ContactHandler($form, $request, $em, $this->getParameter('uploads_directory'));

        if($formHandler->process())
		{
			/* Create the lead in Salesforce for all requests except HR and 'Other' */
			if($contact->getPurpose()->getId() < 6)
			{
				$lead = new Sobject();
				$lead->setName('Lead');
				$lead->setContent(array(
					'SD_Objet_de_la_demande__c' => (($contact->getPurpose() == null) ? null : $contact->getPurpose()->getId()),
					'Company' => $contact->getCompany(),
					'SD_Activite__c' => (($contact->getActivity() == null) ? null : $contact->getActivity()->getId()),
					'Salutation' => (($contact->getGender() == null) ? null : $contact->getGender()->getId()),
					'LastName' => $contact->getLastName(),
					'FirstName' => $contact->getFirstName(),
					'Email' => $contact->getEmail(),
					'Phone' => $contact->getPhone(),
					'Street' => $contact->getAddress(),
					'City' => $contact->getCity(),
					'PostalCode' => $contact->getZipCode(),
					'CountryCode' => $contact->getCountry(),
					'SD_Type_de_produit__c' => (($contact->getProductTypes()->count() < 1) ? null : $contact->getProductTypes()->get(0)->getId()),
					'SD_Newsletter_Promotion__c' => $contact->getPromotionsNews(),
					'Description' => $contact->getMessage(),
					'Status' => 'Nouveau',
					'LeadSource' => 'Website',
					'SD_fonction__c' => '1'
				));

				$response = $this->get('salesforce.service')->create($lead);

				if($response->getCode() != 201)
				{
					$message = (new \Swift_Message('[Web] Problème à la création de piste dans Salesforce'))
						->setFrom($this->getParameter('mailer_sender'))
						->setTo($this->getParameter('mailer_admin'))
						->setBody($this->renderView('ContactUsBundle:Emails:sf_error.html.twig', array(
							'contact' => $contact,
							'message' => 'Code de la réponse HTTP : '.$response->getCode()
						)), 'text/html');

					$this->get('mailer')->send($message);
				}
			}
			/* HR and 'Other' request */
			else
			{
				$sendTo = array();

				if(! empty($contact->getPurpose()->getEmail()))
				{
					$sendTo[] = $contact->getPurpose()->getEmail();
				}

				if($contact->getProductTypes()->count() > 0)
				{
					$result = $em->getRepository('ContactUsBundle:Emailing')->getRecipient($contact->getProductTypes()->get(0), ($contact->getCountry() == 'FR'));

					foreach($result as $emailing)
					{
						$sendTo[] = $emailing->getEmail();
					}
				}

				$message = (new \Swift_Message('[Web] '.$contact->getPurpose()->getEmailSubject()))
					->setFrom($this->getParameter('mailer_sender'))
					->setTo($sendTo)
					->setBody($this->renderView('ContactUsBundle:Emails:info_gsd.html.twig', array(
						'contact' => $contact
					)), 'text/html');

				if($contact->getPurpose()->isFiles())
				{
					if(! empty($contact->getFilePath1()))
					{
						$file = $this->get('kernel')->getRootDir().'/uploads/'.$contact->getFilePath1();
						$fileName = empty($contact->getFileName1()) ? 'file1' : $contact->getFileName1();
						$message->attach(\Swift_Attachment::fromPath($file)->setFilename($fileName.'.'. pathinfo($file, PATHINFO_EXTENSION)));
					}

					if(! empty($contact->getFilePath2()))
					{
						$file = $this->get('kernel')->getRootDir().'/uploads/'.$contact->getFilePath2();
						$fileName = empty($contact->getFileName2()) ? 'file2' : $contact->getFileName2();
						$message->attach(\Swift_Attachment::fromPath($file)->setFilename($fileName.'.'.pathinfo($file, PATHINFO_EXTENSION)));
					}
				}

				$this->get('mailer')->send($message);
			}

			$message = (new \Swift_Message('[Web] '.$contact->getPurpose()->getEmailSubject()))
				->setFrom($this->getParameter('mailer_sender'))
				->setTo($this->getParameter('mailer_admin'))
				->setBody($this->renderView('ContactUsBundle:Emails:info_gsd.html.twig', array(
					'contact' => $contact
				)), 'text/html');

			if($contact->getPurpose()->isFiles())
			{
				if(! empty($contact->getFilePath1()))
				{
					$file = $this->get('kernel')->getRootDir().'/uploads/'.$contact->getFilePath1();
					$fileName = empty($contact->getFileName1()) ? 'file1' : $contact->getFileName1();
					$message->attach(\Swift_Attachment::fromPath($file)->setFilename($fileName.'.'. pathinfo($file, PATHINFO_EXTENSION)));
				}

				if(! empty($contact->getFilePath2()))
				{
					$file = $this->get('kernel')->getRootDir().'/uploads/'.$contact->getFilePath2();
					$fileName = empty($contact->getFileName2()) ? 'file2' : $contact->getFileName2();
					$message->attach(\Swift_Attachment::fromPath($file)->setFilename($fileName.'.'.pathinfo($file, PATHINFO_EXTENSION)));
				}
			}

			$this->get('mailer')->send($message);

			$this->get('session')->getFlashBag()->add('success', 'contact_us.flash.add_contact_success');

            return $this->redirect($this->generateUrl('contact_us_homepage'));
        }

		if($form->getErrors(true)->count() > 0)
		{
			$this->get('session')->getFlashBag()->add('danger', 'contact_us.flash.errors_in_form');
		}

		$result = $this->getDoctrine()->getManager()->getRepository('ContactUsBundle:Purpose')->findAll();
		$output = array();

		foreach($result as $purpose)
		{
			$output[$purpose->getId()] = array(
				$form->getName().'[company]' => $purpose->isCompany(),
				$form->getName().'[activity]' => $purpose->isActivity(),
				$form->getName().'[productTypes][]' => $purpose->isProductTypes(),
				$form->getName().'[fileName1]' => $purpose->isFiles(),
				$form->getName().'[filePath1]' => $purpose->isFiles(),
				$form->getName().'[fileName2]' => $purpose->isFiles(),
				$form->getName().'[filePath2]' => $purpose->isFiles()
			);
		}

        return $this->render('ContactUsBundle:Public:index.html.twig', array(
            'form' => $form->createView(),
			'fields' => $output
        ));
    }
}