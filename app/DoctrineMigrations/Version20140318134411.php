<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140318134411 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function postUp(Schema $schema)
    {
        $events = $this->container->get('doctrine')->getManager()->getRepository('KrakDevs\WebBundle\Entity\Event')->findAll();
        $urlizer = new Urlizer();

        foreach ($events as $event) {
            $slug = $urlizer->transliterate($event->getTitle());
            $slug = $urlizer->urlize($slug);
            $event->setSlug($slug);
        }

        $this->container->get('doctrine')->getManager()->flush();
    }

    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, visible TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE gallery_photo (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, photo_file_key VARCHAR(255) DEFAULT NULL, INDEX IDX_F02A543B4E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE gallery_photo ADD CONSTRAINT FK_F02A543B4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)");
        $this->addSql("ALTER TABLE krakdevs_event ADD gallery_id INT DEFAULT NULL, ADD slug VARCHAR(128) NOT NULL");
        $this->addSql("ALTER TABLE krakdevs_event ADD CONSTRAINT FK_71E7400F4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)");
        $this->addSql("CREATE INDEX IDX_71E7400F4E7AF8F ON krakdevs_event (gallery_id)");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE krakdevs_event DROP FOREIGN KEY FK_71E7400F4E7AF8F");
        $this->addSql("ALTER TABLE gallery_photo DROP FOREIGN KEY FK_F02A543B4E7AF8F");
        $this->addSql("DROP TABLE gallery");
        $this->addSql("DROP TABLE gallery_photo");
        $this->addSql("DROP INDEX IDX_71E7400F4E7AF8F ON krakdevs_event");
        $this->addSql("ALTER TABLE krakdevs_event DROP gallery_id, DROP slug");
    }
}
