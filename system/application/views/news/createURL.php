<h2>Create News</h2>
<?php echo form_open('newsURL/create');?>
    <table border="0" style="width: 57%;">
        <tr>
            <td style="width: 10%;">Title:</td>
            <td colspan="2">
            <?php echo form_input(
                array(
                    'name' => 'title',
                    'size' => '60')
                );
            ?>
            </td>
        </tr>
		<tr>
            <td style="width: 10%;">Hashtag:</td>
            <td colspan="2">
            <?php echo form_input(
                array(
                    'name' => 'hashtag',
                    'size' => '60')
                );
            ?>
            </td>
        </tr>
        <tr>
            <td>URL:</td>
            <td colspan="2">
            <?php echo form_input(
                array(
                    'name' => 'url',
                    'size' => '60')
                );
            ?>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Categories:</td>
            <td style="width: 400px;">
            <?php echo form_multiselect('category_id[]', $categories, array(), 'size="10"');?>
            </td>
            <td style="width: auto;">
            <?php echo form_submit('Go','Go');?>
            </td>
        </tr>
		</table>
		<table style="width: 57%;">
        <tr>
			<?php  if (!isset($accessToken)) { ?>
            <td style="vertical-align: top;">
                    <br><br>
                    <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
            </td>
			<?php } else { ?>
            <td style="width: 409px; vertical-align: top;">
			Facebook pages:<br>
			<?php 
				function compareByName($facebook_pages, $b) {
					return strcmp($facebook_pages["name"], $b["name"]);
				}
				
				usort($facebook_pages, 'compareByName');
			?>
            <?php foreach ($facebook_pages as $page) : ?>
                <?php echo form_checkbox(
                    array(
                        'name'  => 'fb_page[]',
                        'id'    => 'fb_page_' . $page['id'],
                        'value' =>  $page['id'],
                    )
                ); ?>
                <?php echo form_label($page['name'], 'fb_page_' . $page['id']); ?><br/>
            <?php endforeach; ?>
            </td>
			<?php }	?>
			<?php if(isset($_SESSION['twitter_oauth_token'])) { ?>
			<td>
				<?php echo form_checkbox(
                    array(
                        'name'  => 'enable_tweet',
                        'id'    => 'tweet',
                        'value' => 'tweet'
                    )
                ); ?><?php echo form_label("Tweet it", "tweet"); ?><br/>
			</td>
			<?php } else {?>
				
			<td style="vertical-align: top;">
                    <br><br>
                    <a href="http://chicagoscifi.com/new_site/news/twitterAuth">Login with Twitter</a>
            </td>
			<?php } ?>
        </tr>
    </table>
<?php echo form_close();?>
