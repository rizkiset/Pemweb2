<?php namespace App\Controllers;

class Page extends BaseController
{
   public function Aboute()
    {
    echo "about page";
    }

    public function Contact()
    {
        echo "Contact page";
    }

    public function Faqs ()
    {
        echo "Faqs page";
    }

    public function tols ()
{
    echo "Halaman Term of Service";
}
    public function bio()
{
    echo "<h1>BIODATA<h2>" ;
    echo "Nama   : M Rizki Setio Budi";
    echo "Alamat : Tambar Jogoroto Jombang";
    echo "Sememster : 4 ";
    echo "Kelas  : B ";
}
}