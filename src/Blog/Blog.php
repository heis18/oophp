<?php

/**
 * A class for movie-methodes.
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

 namespace Heis\Blog;

 use Anax\Commons\AppInjectableInterface;
 use Anax\Commons\AppInjectableTrait;

/**
* A movie class
*/
class Blog implements AppInjectableInterface
{
    use AppInjectableTrait;

    private $db;
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
}
