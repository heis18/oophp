<?php
/**
 * A class for movie-methodes.
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

 namespace Heis\Blog;

 use Anax\Commons\AppInjectableInterface;
 use Anax\Commons\AppInjectableTrait;
 use function Anax\View\url;
 use Heis\TextFilter;
 use DateTime;

/**
* A movie class
*/
class Blog implements AppInjectableInterface
{
    use AppInjectableTrait;

    private $contentTitle;
    private $contentPath;
    private $contentSlug;
    private $contentData;
    private $contentType;
    private $contentFilter;
    private $contentPublish;
    private $contentId;

    private $created;
    private $updated;
    private $deleted;

    public function __construct($data = null)
    {
        if ($data == null) {
            $this->contentId = -1;
            return;
        }

        $this->contentId= $data->id;
        $this->created = $data->created;
        $this->updated = $data->updated;
        $this->deleted = $data->deleted;

        $this->contentTitle = $data->title;
        $this->contentSlug = $data->slug;
        $this->contentData = $data->data;
        $this->contentType = $data->type;
        $this->contentFilter = $data->filter;
        $this->contentPublish = $data->published;
    }

    public function createDummy() : object
    {
        $blog = new Blog();
        $blog->contentId = -1;
        $blog->contentTitle = "--contentTitle--";
        $blog->contentPath = "--contentPath--";
        $blog->contentSlug = "--contentSlug--";
        $blog->contentData = "--contentData--";
        $blog->contentType = "--contentTitle--";
        $blog->contentFilter = "--contentTitle--";
        $blog->contentPublish = "--contentFilter--";
        $blog->contentSlug = "--contentSlug--";
        $blog->created = null;
        $blog->updated = null;
        $blog->deleted = null;
        return $blog;
    }

    public function getContentTitle()
    {
        return $this->contentTitle;
    }

    public function setContentTitle($data)
    {
        $this->contentTitle = $data;
    }


    public function getId()
    {
        return $this->contentId;
    }


    public function getContentPath()
    {
        return $this->contentPath;
    }


    public function setContentPath($data)
    {
        if ($data == "") {
            $data = null;
        }

        $this->contentPath = $data;
    }


    public function getContentData()
    {
        return $this->contentData;
    }


    public function setContentData($data)
    {
        $this->contentData = $data;
    }


    public function getContentType()
    {
        return $this->contentType;
    }


    public function setContentType($data)
    {
        $this->contentType = $data;
    }

    public function getContentFilter()
    {
        return $this->contentFilter;
    }

    public function setContentFilter($data)
    {
        $this->contentFilter = $data;
    }


    public function getContentPublish()
    {
        return $this->contentPublish;
    }

    public function getContentPublishISO()
    {
        if ($this->getContentPublish() == null) {
            return "";
        }

        $date = new DateTime($this->getContentPublish());
        return $date->format(DateTime::ATOM);
    }


    public function setContentPublish($data)
    {
        $this->contentPublish = $data;
    }

    public function getContentSlug()
    {
        return $this->contentSlug;
    }

    public function setContentSlug($data)
    {
        $this->contentSlug = $data;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function getDeletedFormatted($format = "Y-m-d")
    {
        if ($this->deleted == null) {
            return "";
        }

        return $this->deleted->format($format);
    }

    public function getUpdatedFormatted($format = "Y-m-d")
    {
        if ($this->updated == null) {
            return "";
        }

        $date = new DateTime($this->updated);
        return $date->format($format);
    }

    public function getUpdatedISO()
    {
        if ($this->updated == null) {
            return "";
        }

        $date = new DateTime($this->updated);
        return $date->format(DateTime::ATOM);
    }

    public function getContentPublishFormatted($format = "Y-m-d")
    {
        if ($this->contentPublish == null) {
            return "";
        }

        $date = new DateTime($this->updated);
        return $date->format($format);
    }

    public function getCreatedFormatted($format = "Y-m-d")
    {
        if ($this->created == null) {
            return "";
        }

        $date = new DateTime($this->created);
        return $date->format($format);
    }

    public function createLink()
    {
        $blogurl = url("blog/page?route=");

        $pathOrSlug = "";
        if (($this->getContentSlug() ?? "") != "") {
            $pathOrSlug = "slug/".$this->getContentSlug();
        } else if (($this->getContentPath() ?? "") != "") {
            $pathOrSlug = "path/".$this->getContentPath();
        } else {
            $pathOrSlug = "id/".$this->getId();
        }

        return $blogurl.$pathOrSlug;
    }

    public function getFormattedContent()
    {
        $textFilter = new \Heis\TextFilter\MyTextFilter();
        $contentFilters = explode(',', $this->getContentFilter());

        $activfilter = [];
        foreach ($contentFilters as $filter) {
            $activfilter[] = $textFilter->getFilter($filter);
        }

        return $textFilter->parse($this->getContentData(), $activfilter);
    }

    public static function getAllByType($database, $type)
    {
        $res = [];
        $sql = "SELECT * FROM content where type = ? ;";
        $resultSet = $database->executeFetchAll($sql, [$type]);

        foreach ($resultSet as $item) {
            $res[] = new Blog($item);
        }

        return $res;
    }

    public static function getBySlug($database, $type, $search)
    {
        $sql = "SELECT * FROM content WHERE type = ? AND slug = ? ;";
        $res = $database->executeFetchAll($sql, [$type, $search]);
        $page = new Blog($res[0]);
        return $page;
    }

    public static function getByPath($database, $type, $search)
    {
        $sql = "SELECT * FROM content WHERE type = ? AND path = ? ;";
        $res = $database->executeFetchAll($sql, [$type, $search]);
        $page = new Blog($res[0]);
        return $page;
    }

    public static function getBlog($database, $id)
    {
        $sql = "SELECT * FROM content WHERE id = ?;";
        $data = $database->executeFetchAll($sql, [$id]);
        return new Blog($data[0]);
    }
}
