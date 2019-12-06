<?php
/*
Template Name: Alphabet
*/
global $SMTheme;
get_header();
?>
    <h1 class="page-title">�����</h1>
    <?php
function sorting($posts) // �������� �������������� ������� � �������� � ������������ ������, ���� - ������ ����� ������
{
    $sorting_by_letters = [];
    $prev = null;
    foreach ($posts as $post_item)
    {
        $title=get_the_title($post_item);
        $link=get_the_permalink($post_item);
        $letter = mb_substr($title, 0, 1, 'utf-8');
        if ($letter != $prev) {
            $prev = $letter;
    }
        $sorting_by_letters[$letter][] = $title.';'.$link;
    }
    return $sorting_by_letters;
}
$cat_id = get_cat_ID('�������������');
$args = array( 'numberposts' => -1, 'category'    => $cat_id); // ����� ���������� ���������� ������ ���� �� ����������
$posts = get_posts($args);
$sorting_by_letters=sorting ($posts);
ksort($sorting_by_letters); // ��������� �� ������ �� ��������


foreach ($sorting_by_letters as $key=>$letter) // ������� ������ ������ �� ������ ��������
     {
    echo '&nbsp;&nbsp;&nbsp;'. mb_strtoupper( $key, 'utf-8' ) . "<br>"; // �����
    asort($letter);    // ��������� ������ ������ �� ��� �����
    foreach ($letter as $post_item)
    {
        $post_cut=mb_stristr($post_item, ';', true);
        $link_item=mb_stristr($post_item, ';');
        $link_cut=mb_substr( $link_item, 1);
        ?>
        <li><a href="<?php echo $link_cut; ?>" target="_blank"><?php echo $post_cut."<br>"; ?></a></li>
    <?php  }
}
   ?>
<?php
get_footer();
?>
