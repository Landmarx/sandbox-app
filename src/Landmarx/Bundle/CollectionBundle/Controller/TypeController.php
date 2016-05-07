<?php
namespace Landmarx\Bundle\CollectionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

use Landmarx\Bundle\CoreBundle\Controller\Controller;
use Landmarx\Bundle\CollectionBundle\Document\Type;
use Landmarx\Bundle\CollectionBundle\Form\Type\TypeType;

class TypeController extends Controller
{
    /**
     * @Route("/", name="landmarx_type_index")
     * @Template("LandmarxCollectionBundle:Type:index.html.twig")
     */
    public function indexAction()
    {
        $types = $this->get('doctrine_mongodb')
                                ->getManager()
                                ->getRepository('LandmarxCollectionBundle:Type')
                                ->findAllOrderedByName();

        if (!$types) {
            throw $this->createNotFoundException('No types found.');
        }

        return $this->render('LandmarxCollectionBundle:Type:index.html.twig', array('types' => $types));
    }

    /**
     * @Route("/{slug}", name="landmarx_type_show")
     * @Template("LandmarxCollectionBundle:Type:show.html.twig")
     */
    public function showAction($slug)
    {
        $type = $this->getDoctrine()
                       ->getRepository('LandmarxCollectionBundle:Type')
                       ->findBySlug($slug);

        if (!$type) {
            throw $this->createNotFoundException('No collection type found.');
        }

        return $this->render('LandmarxCollectionBundle:Type:show.html.twig', array('type' => $type));
    }
}
