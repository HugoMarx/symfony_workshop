<?php

namespace App\Tests\Controller;

use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TicketControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $ticketRepository;
    private string $path = '/ticket/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->ticketRepository = $this->manager->getRepository(Ticket::class);

        foreach ($this->ticketRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ticket index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'ticket[title]' => 'Testing',
            'ticket[description]' => 'Testing',
            'ticket[created]' => 'Testing',
            'ticket[modified]' => 'Testing',
            'ticket[completed]' => 'Testing',
            'ticket[author]' => 'Testing',
            'ticket[status]' => 'Testing',
            'ticket[priority]' => 'Testing',
            'ticket[assignee]' => 'Testing',
        ]);

        self::assertResponseRedirects('/ticket');

        self::assertSame(1, $this->ticketRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }

    public function testShow(): void
    {
        $fixture = new Ticket();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCreated('My Title');
        $fixture->setModified('My Title');
        $fixture->setCompleted('My Title');
        $fixture->setAuthor('My Title');
        $fixture->setStatus('My Title');
        $fixture->setPriority('My Title');
        $fixture->setAssignee('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Ticket');

        // Use assertions to check that the properties are properly displayed.
        $this->markTestIncomplete('This test was generated');
    }

    public function testEdit(): void
    {
        $fixture = new Ticket();
        $fixture->setTitle('Value');
        $fixture->setDescription('Value');
        $fixture->setCreated('Value');
        $fixture->setModified('Value');
        $fixture->setCompleted('Value');
        $fixture->setAuthor('Value');
        $fixture->setStatus('Value');
        $fixture->setPriority('Value');
        $fixture->setAssignee('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'ticket[title]' => 'Something New',
            'ticket[description]' => 'Something New',
            'ticket[created]' => 'Something New',
            'ticket[modified]' => 'Something New',
            'ticket[completed]' => 'Something New',
            'ticket[author]' => 'Something New',
            'ticket[status]' => 'Something New',
            'ticket[priority]' => 'Something New',
            'ticket[assignee]' => 'Something New',
        ]);

        self::assertResponseRedirects('/ticket');

        $fixture = $this->ticketRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getCreated());
        self::assertSame('Something New', $fixture[0]->getModified());
        self::assertSame('Something New', $fixture[0]->getCompleted());
        self::assertSame('Something New', $fixture[0]->getAuthor());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getPriority());
        self::assertSame('Something New', $fixture[0]->getAssignee());

        $this->markTestIncomplete('This test was generated');
    }

    public function testRemove(): void
    {
        $fixture = new Ticket();
        $fixture->setTitle('Value');
        $fixture->setDescription('Value');
        $fixture->setCreated('Value');
        $fixture->setModified('Value');
        $fixture->setCompleted('Value');
        $fixture->setAuthor('Value');
        $fixture->setStatus('Value');
        $fixture->setPriority('Value');
        $fixture->setAssignee('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/ticket');
        self::assertSame(0, $this->ticketRepository->count([]));

        $this->markTestIncomplete('This test was generated');
    }
}
