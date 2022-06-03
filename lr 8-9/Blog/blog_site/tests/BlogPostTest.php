<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogPostTest extends WebTestCase
{
    private array $trueCredentials = ['username' => 'dima', 'password' => '123456'];
    private array $falseCredentials = ['username' => 'root@mail.ru', 'password' => 'password'];

    public function testHomePage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleContains('Blog');
        $this->assertCount(10, $crawler->filter('.single-blog-area'));
        $link = $crawler->selectLink('Заголовок № 1')->link();
        $client->click($link);
        $this->assertResponseStatusCodeSame(200);
        $this->assertPageTitleContains('Post');
    }

//    public function testLogin(): void
//    {
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/');
//        $link = $crawler->selectLink('Вход')->link();
//        $client->click($link);
//        $this->assertResponseStatusCodeSame(200);
//        $this->assertPageTitleContains('Авторизация');
//        $client->submitForm('Авторизоваться', $this->falseCredentials);
//        $this->assertResponseRedirects();
//        $client->followRedirect();
//        $this->assertSelectorTextContains('.alert.alert-danger', 'Invalid credentials.');
//        $client->submitForm('Авторизоваться', $this->trueCredentials);
//        $this->assertResponseRedirects();
//        $client->followRedirect();
//        $this->assertPageTitleContains('QaA');
//    }
//
//    public function testAdding()
//    {
//        $client = static::createClient();
//        $client->request('GET', '/add/question');
//        $this->assertResponseRedirects();
//        $client->followRedirect();
//        $this->assertPageTitleContains('Авторизация');
//        $client->submitForm('Авторизоваться', $this->trueCredentials);
//        $this->assertResponseRedirects();
//        $client->followRedirect();
//        $question = [
//            'question[title]' => '      ',
//            'question[text]' => '      ',
//            'question[category][name]' => '      '
//        ];
//        $client->submitForm('Отправить на проверку', $question);
//        $this->assertResponseStatusCodeSame(500);
//        $client->request('GET', '/add/question');
//        $question = [
//            'question[title]' => 'Заголовок',
//            'question[text]' => 'Текст',
//            'question[category][name]' => 'Категория'
//        ];
//        $client->submitForm('Отправить на проверку', $question);
//        $this->assertResponseRedirects();
//        $client->followRedirect();
//        $this->assertPageTitleContains('QaA');
//    }
}
