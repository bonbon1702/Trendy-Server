<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 1/8/2015
 * Time: 10:40 AM
 */

namespace Services;


use Core\BaseService;
use Repositories\TagLinkContentRepository;

class TagLinkContentService implements BaseService{

    private $tagLinkContentRepository;
    private $tagLinkRepository;
    function __construct(TagLinkContentRepository $tagLinkContentRepository,TagLinkRepository $tagLinkRepository)
    {
        // TODO: Implement __construct() method.
        $this->tagLinkContentRepository = $tagLinkContentRepository;
        $this->tagLinkRepository = $tagLinkRepository;
    }

    public function create(array $data)
    {
        $tag_id = $data['tag_id'];
        $tag_content_id = $data['tag_content_id'];
        $post = $this->tagLinkRepository->get($tag_id);
        if ($post) {
            $this->tagLinkContentRepository->create(array(
                'tag_id' => $tag_id,
                'tag_content_id' => $tag_content_id,
            ));
        }
        return true;
    }

    public function update(array $data)
    {
        $column = $data['column'];
        $value = $data['value'];
        $tag_id = $data['tag_id'];
        $tag_content_id = $data['tag_content_id'];
        $this->albumRepository->update($column, $value, array(
            'tag_id' => $tag_id,
            'tag_content_id' => $tag_content_id,));

    }

    public function delete($column, $value)
    {
        // TODO: Implement delete() method.
        $this->albumRepository->delete($column,$value);
    }

}