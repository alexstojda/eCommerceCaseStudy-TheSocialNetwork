<tr>
    <td colspan="2"><a href="<?= URL . 'wall?u='. $this->post->getPostBy()?>"><?= $this->post->getPostByName(); ?></a></td>
</tr>
<tr>
    <td class="gg-kixb" rowspan="2"><?= $this->post->getPostText() ?></br></br></br>
        <strong><i><?= $this->post->getDate() ?></strong></i></td>
    <td class="gg-kixb">Like / Dislike</td>
</tr>
<tr>
    <td class="gg-pxng">Post's Karma</td>
</tr>
<!--TODO: REDO POST LOOK AND WALL TOO-->