<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Links;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LinkController extends Controller
{
    /**
     * @Route("/")
     */
    public function formAction()
    {
        return $this->render("@App/link/index.html.twig");
    }

    /**
     * @Route("/add")
     * @Method({"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addAction(Request $request)
    {
        $url = $request->request->get("url");
        $short_url = $request->request->get("short_url");

        if ($this->CheckUrlUnique($short_url)){
            $link = new Links();
            $em = $this->getDoctrine()->getManager();
            $link->setUrl($url);
            $link->setShortUrl($short_url);
            $em->persist($link);
            $em->flush();
            $status = 200;
        }else{
            $status = 400;
        }

       return new JsonResponse([
           "result" => "http://127.0.0.1:8000/s/".$short_url
       ],$status);
    }
    /**
     * @Route("/s/{short_url}")
     * @Method({"GET","HEAD"})
     * @param string $short_url
     * @return Response
     */
    public function shortUrlAction(string $short_url)
    {
        $link = $this->getDoctrine()
            ->getRepository(Links::class)
            ->findOneBy(['short_url'=>$short_url]);
        if ($link){
            return $this->redirect($link->getUrl());
        }else{
            return new Response("Данный <b>".$short_url."</b> короткий url не найден!");
        }
    }

    /**
     * @param $short_url
     * @return bool
     */
    public function CheckUrlUnique($short_url)
    {
        $link = $this->getDoctrine()
            ->getRepository(Links::class)
            ->findOneBy(['short_url'=>$short_url]);
        if ($link){
            return false;
        }else{
            return true;
        }
    }
}