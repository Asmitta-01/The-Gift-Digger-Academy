<?php

add_action('admin_init', 'restrict_wpadmin_access');
if (!function_exists('restrict_wpadmin_access')) {
    function restrict_wpadmin_access()
    {
        if (wp_doing_ajax() || current_user_can('edit_posts')) {
            return;
        } else {
            wp_redirect(get_home_url());
            exit;
        };
    };
};

function hide_admin_bar()
{
    if (!current_user_can('edit_posts')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'hide_admin_bar');

function add_search_form($items, $args)
{
    if (current_user_can('edit_posts')) {
        $items .= '<li class="menu-item">'
            . '<a href="' . admin_url() . '"><i class="fas fa-cog px-1"></i></a> '
            . '</li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);

function my_login_styles()
{
    wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.css');
    wp_enqueue_style('login-custom-style', get_stylesheet_directory_uri() . '/login.css');
}
add_action('login_enqueue_scripts', 'my_login_styles');


add_shortcode('latest-articles', function () {
    $posts = get_posts([
        'numberposts' => 3,
        'orderby' => 'date'
    ]);
    ob_start();
?>
    <div class="row">
        <?php foreach ($posts as $post) : ?>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card" id="post-<?= $post->ID ?>">
                    <?php if (has_post_thumbnail($post)) { ?>
                        <?= get_the_post_thumbnail($post, attr: ['class' => 'card-img-top']) ?>
                    <?php } ?>
                    <div class="card-body p-3">
                        <h3><a href="<?= get_the_permalink($post) ?>"><?= get_the_title($post) ?></a></h3>
                        <div class="small grid-post-meta-container p-1">
                            <span class="entry-author">
                                <i class="far fa-user orange-color"></i>
                                <a href="<?php echo esc_url(get_author_posts_url($post->post_author)); ?>">
                                    <?= get_user_by('ID', $post->post_author)->display_name ?>
                                </a>
                            </span>
                            &nbsp;
                            <span class="entry-comments">
                                <i class="fas fa-comments orange-color"></i>
                                <?php comments_number(__('0 Comments', 'education-insight'), __('0 Comments', 'education-insight'), __('% Comments', 'education-insight')); ?>
                            </span>
                        </div>
                        <p class="card-text"><?= get_the_excerpt($post) ?></p>
                    </div>
                    <div class="card-footer d-flex">
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
<?php
    return ob_get_clean();
});

add_shortcode('grid-courses', function ($atts) {
    $conditions = [
        'post_type' => 'tgd_course',
        'orderby' => 'date'
    ];
    if ($atts !== null && isset($atts['latest']))
        $conditions['numberposts'] = 3;
    $posts = get_posts($conditions);
    ob_start();
?>
    <div class="row">
        <?php foreach ($posts as $post) : ?>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card h-100" id="post-<?= $post->ID ?>">
                    <?php if (has_post_thumbnail($post)) { ?>
                        <?= get_the_post_thumbnail($post, attr: ['class' => 'card-img-top w-100', 'style' => "object-fit: cover; height: 230px;"]) ?>
                    <?php } ?>
                    <div class="card-body p-3">
                        <h3><a href="<?= get_the_permalink($post) ?>" style="text-decoration: none"><?= get_the_title($post) ?></a></h3>
                        <div class="small grid-post-meta-container p-1 my-2">
                            <span class="entry-author">
                                <a href="<?php echo esc_url(get_author_posts_url($post->post_author)); ?>" style="text-decoration: none;">
                                    <img src="<?= get_avatar_url(wp_get_current_user()->user_email) ?>" alt="" class="rounded-circle mr-2" width="20">
                                    <?= get_user_by('ID', $post->post_author)->display_name ?>
                                </a>
                            </span>
                            &nbsp;
                            <span class="font-weight-bold  orange-color">
                                <?= get_post_meta($post->ID, 'tgd_course_amount', true) ?> XAF
                            </span>
                        </div>
                        <p class="card-text"><?= substr(get_the_excerpt($post), 0, 170) ?></p>
                        <div class="link-more">
                            <a href="<?= get_permalink($post) ?>" class="more-link" style="text-decoration: none;">Read more</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
<?php
    return ob_get_clean();
});

if (!post_type_exists('tgd_course')) {
    function register_tgd_course_type()
    {
        register_post_type(
            'tgd_course',
            array(
                'labels'      => array(
                    'name'          => 'Courses',
                    'singular_name' => 'Course',
                ),
                'description' => 'Training course made by a teacher form the Gift Digger Academy',
                'public'      => true,
                'show_ui'     => true,
                'rewrite' => array(
                    'slug' => 'courses'
                ),
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-pressthis',
                'has_archive' => false
            )
        );

        add_post_type_support('tgd_course', 'thumbnail');
        add_post_type_support('tgd_course', 'page-attributes');
        add_post_type_support('tgd_course', 'excerpt');
        add_post_type_support('tgd_course', 'author');
        flush_rewrite_rules();
    }
    add_action('init', 'register_tgd_course_type');
}

add_role('mentor', "Mentor", get_role('author')->capabilities);

function tgd_bn_custom_meta_offer()
{
    add_meta_box(
        'bn_meta',
        __('Courses Custom Fields', 'education-academy-coach'),
        'tgd_meta_callback_courses',
        'tgd_course',
        'normal',
        'high'
    );
}
if (is_admin()) {
    add_action('admin_menu', 'tgd_bn_custom_meta_offer');
}

function tgd_meta_callback_courses($post)
{
    wp_nonce_field(basename(__FILE__), 'tgd_meta_courses_nonce');
    $tgd_course_amount = get_post_meta($post->ID, 'tgd_course_amount', true);
    $tgd_course_videos = get_post_meta($post->ID, 'tgd_course_videos', true);
?>
    <table id="list">
        <tbody id="the-list" data-wp-lists="list:meta">
            <tr id="meta-8">
                <td class="left">
                    <?php esc_html_e('Course Amount(in XAF)', 'education-academy-coach') ?>
                </td>
                <td class="left">
                    <input type="number" step="500" name="tgd_course_amount" id="tgd_course_amount" value="<?php echo esc_attr($tgd_course_amount); ?>" />
                </td>
            </tr>
            <tr>
                <td style="font-weight: bolder;">Courses videos list</td>
            </tr>
            <?php
            $c = 0;
            if (is_array($tgd_course_videos) && count($tgd_course_videos) > 0) {
                foreach ($tgd_course_videos as $video) {
                    if (isset($video['title']) || isset($video['path'])) {
            ?>
                        <tr id="meta-<?= $c ?>">
                            <td class="left">
                                <span><?= '#' . $c ?></span>
                                <input type="text" name="tgd_course_titles[]" value="<?php echo esc_attr($video['title']); ?>" placeholder="<?= esc_html_e('Video title', 'education-academy-coach') ?>" />
                            </td>
                            <td class="left">
                                <input type="file" accept="video/*" name="tgd_course_videos[]">
                            </td>
                            <td class="remove"><button>Remove</button></td>
                        </tr>
            <?php
                        $c = $c + 1;
                    }
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="add">
                <td><button><?php _e('Add Video Course'); ?></button></td>
            </tr>
        </tfoot>
    </table>
    <script>
        jQuery(document).ready(function() {
            var count = <?php echo $c; ?>;
            jQuery(".add").click(function() {
                count = count + 1;
                jQuery('#the-list').append(
                    `<tr id="meta-${count}">
                        <td class="left"><span>#${count}</span><input type="text" name="tgd_course_titles[]" value="" placeholder="<?= esc_html_e('Video title', 'education-academy-coach') ?>" /></td>
                        <td class="left"><input type="file" name="tgd_course_videos[]" accept="video/*"></td>
                        <td class="remove" onclick="jQuery(this).parent().remove();"><button>Remove video</button></td>
                    </tr>`
                );
                return false;
            });
            jQuery(".remove").click(function() {
                jQuery(this).parent().remove();
            });
        });
    </script>
<?php
}

function tgd_custom_field_save($post_id)
{
    if (
        !isset($_POST['tgd_meta_courses_nonce'])
        || wp_verify_nonce($_POST['tgd_meta_courses_nonce'], basename(__FILE__) === false)
    ) {
        return $post_id;
    }

    if (!current_user_can('edit_posts', $post_id)) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if (isset($_POST['tgd_course_amount'])) {
        update_post_meta($post_id, 'tgd_course_amount', sanitize_text_field($_POST['tgd_course_amount']));
    }

    if (isset($_POST['tgd_course_titles']) && isset($_FILES['tgd_course_videos'])) {
        $tgd_course_videos = array();
        $titles = $_POST['tgd_course_titles'];
        $videos = $_FILES['tgd_course_videos'];
        $video_count = count($titles);

        for ($i = 0; $i < $video_count; $i++) {
            if ($titles[$i] != '' && !empty($videos['name'][$i])) {
                if (!function_exists('wp_handle_upload')) {
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                }
                $uploadedfile = array(
                    'name' => $videos['name'][$i],
                    'type' => $videos['type'][$i],
                    'tmp_name' => $videos['tmp_name'][$i],
                    'error' => $videos['error'][$i],
                    'size' => $videos['size'][$i]
                );
                $upload_overrides = array('test_form' => false);
                $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

                if ($movefile && !isset($movefile['error'])) {
                    // File was uploaded successfully, add it to the videos array
                    $tgd_course_videos[$i] = array(
                        'title' => sanitize_text_field($titles[$i]),
                        'path' => esc_url_raw($movefile['url']),
                        'type' => $movefile['type']
                    );
                } else {
                    // There was an error uploading the file
                    error_log($movefile['error'], 3, ABSPATH . 'wp-content/debug.log');
                }
            }
        }
        update_post_meta($post_id, 'tgd_course_videos', $tgd_course_videos);
    }
}
add_action('save_post', 'tgd_custom_field_save');

add_action('add_user_profile', 'my_added_login_field');
add_filter('register_form', 'my_added_login_field');
function my_added_login_field()
{
    $first_name = (!empty($_POST['first_name'])) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = (!empty($_POST['last_name'])) ? sanitize_text_field($_POST['last_name']) : '';
?>
    <div class="row">
        <div class="col">
            <label for="first_name">First name<br>
                <input type="text" tabindex="20" size="20" value="<?= $first_name ?>" class="input" id="first_name" name="first_name">
            </label>
        </div>
        <div class="col">
            <label for="last_name">Last name<br>
                <input type="text" tabindex="20" size="20" value="<?= $last_name ?>" class="input" id="last_name" name="last_name">
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="birthday">Birthday<br></label>
            <input class="w-100" type="date" name="birthday" id="birthday">
        </div>
        <div class="col">
            <label for="gender">Gender<br>
            </label>
            <select name="gender" id="gender" class="w-100">
                <option value="male" selected>Male</option>
                <option value="female">Female</option>
            </select>
        </div>
    </div>
<?php
}

add_filter('registration_errors', 'my_registration_errors', 10, 3);
function my_registration_errors($errors, $sanitized_user_login, $user_email)
{
    if (empty($_POST['first_name']) || !empty($_POST['first_name']) && trim($_POST['first_name']) == '') {
        $errors->add('first_name_error', sprintf('<strong>%s</strong>: %s', __('Error', 'mydomain'), __('You must include a first name.', 'mydomain')));
    }
    if (empty($_POST['last_name']) || !empty($_POST['last_name']) && trim($_POST['last_name']) == '') {
        $errors->add('last_name_error', sprintf('<strong>%s</strong>: %s', __('Error', 'mydomain'), __('You must include a last name.', 'mydomain')));
    }
    if (empty($_POST['birthday'])) {
        $errors->add('birthday_error', sprintf('<strong>%s</strong>: %s', __('Error', 'mydomain'), __('You must enter your birth day.', 'mydomain')));
    }

    return $errors;
}

add_action('user_register', 'my_user_register');
function my_user_register($user_id)
{
    if (!empty($_POST['first_name'])) {
        update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
    }
    if (!empty($_POST['last_name'])) {
        update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));
    }
    if (!empty($_POST['birthday'])) {
        update_user_meta($user_id, 'birthday', $_POST['birthday']);
    }
    if (!empty($_POST['gender'])) {
        update_user_meta($user_id, 'gender', sanitize_text_field($_POST['gender']));
    }
}

add_shortcode('guests-only', function ($atts, $content = '') {
    if (!is_user_logged_in() && wp_get_current_user()->courses == null) {
        return do_shortcode($content);
    }

    return;
});

add_shortcode('video-chat', function ($atts, $content = '') {
    if (!is_user_logged_in() && wp_get_current_user()->courses == null) {
        return;
    }
    ob_start();
?>
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <?php
                ob_start();
                do_action('create-jwt-token');
                $token = ob_get_clean();
                ?>
                <div id="jaas-container" style="background-color: #162039; color: white">
                    <?php if (in_array('subscriber', wp_get_current_user()->roles)) : ?>
                        <div class="container p-5">
                            <h1 class="text-white">Enter a room</h1>
                            <p>Check for an active mentor in the list below and enter his room.</p>
                            <svg xmlns="http://www.w3.org/2000/svg" height="5em" class="mt-3" viewBox="0 0 576 512" style="fill: white;">
                                <path d="M544 416L32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32l512 0c17.7 0 32-14.3 32-32s-14.3-32-32-32zm22.6-137.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L480 274.7 480 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 210.7-41.4-41.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l96 96c12.5 12.5 32.8 12.5 45.3 0l96-96zm-320-45.3c-12.5-12.5-32.8-12.5-45.3 0L160 274.7 160 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 210.7L54.6 233.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l96 96c12.5 12.5 32.8 12.5 45.3 0l96-96c12.5-12.5 12.5-32.8 0-45.3z" />
                            </svg>
                            <div class="row mt-3">
                                <?php foreach (get_users(['role' => 'mentor']) as $user) : ?>
                                    <button class="col-auto mentor-block mx-1" data-mentor-name="<?= ucwords(mb_strtolower($user->display_name)) ?>">
                                        <img src="<?= get_avatar_url($user->user_email) ?>" alt="" class="rounded-circle mr-2" width="20">
                                        <?= $user->display_name ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src='https://8x8.vc/vpaas-magic-cookie-d3d26ab9b279487eb7a8f213fb7e0537/external_api.js' async></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        const parentContainer = document.getElementById('jaas-container');
        const content = parentContainer.innerHTML;
        <?php if (in_array('mentor', wp_get_current_user()->roles)) : ?>
            window.onload = () => {
                const options = {
                    roomName: "vpaas-magic-cookie-d3d26ab9b279487eb7a8f213fb7e0537/<?= ucwords(mb_strtolower(wp_get_current_user()->display_name)) ?>Room",
                    parentNode: parentContainer,
                    lang: 'fr',
                    readOnlyName: true,
                    jwt: "<?= $token ?>"
                };
                const api = new JitsiMeetExternalAPI("8x8.vc", options);
            }
        <?php else : ?>
            const options = {
                roomName: "vpaas-magic-cookie-d3d26ab9b279487eb7a8f213fb7e0537/",
                parentNode: parentContainer,
                lang: 'fr',
                readOnlyName: true,
                jwt: "<?= $token ?>",
                configOverwrite: {
                    prejoinPageEnabled: false,
                    toolbarButtons: ['chat', 'hangup', 'microphone', 'camera', 'raisehand', 'videoquality', 'fullscreen'],
                    startWithAudioMuted: true,
                    startWithVideoMuted: true
                }
            };
            Array.from(document.querySelectorAll('.mentor-block')).forEach(function(element) {
                element.addEventListener('click', function() {
                    options.roomName += element.getAttribute('data-mentor-name') + 'Room';
                    parentContainer.innerHTML = "";
                    const api = new JitsiMeetExternalAPI("8x8.vc", options);
                    api.addEventListener('readyToClose', function() {
                        parentContainer.innerHTML = content;
                    });
                })
            });
        <?php endif; ?>
    </script>
<?php
    return ob_get_clean();
});

add_action('rest_api_init', function () {
    register_rest_route('endpoint/v1', '/jaas', array(
        'methods' => 'POST',
        'callback' => 'my_endpoint_callback',
        'permission_callback' => __return_true()
    ));
});

function my_endpoint_callback($request)
{
    $room = $request->get_param('fqn');
    $event = $request->get_param('eventType');
    if ($event == 'PARTICIPANT_JOINED' || $event == 'PARTICIPANT_LEFT') {
        $data = $request->get_param('data');
        if (isset($data['id'])) {
            $user = get_user_by('ID', $data['id']);
            if ($user === false)
                return;
        }
    }

    // Do something with the parameters, such as querying the database
    // ...

    // Return a response
    return new WP_REST_Response(array(
        'success' => true,
        'data' => array(),
    ), 200);
}
