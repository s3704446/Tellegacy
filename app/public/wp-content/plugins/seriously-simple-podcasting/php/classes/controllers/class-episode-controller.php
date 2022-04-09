<?php

namespace SeriouslySimplePodcasting\Controllers;

use SeriouslySimplePodcasting\Renderers\Renderer;
use SeriouslySimplePodcasting\Repositories\Episode_Repository;
use SeriouslySimplePodcasting\Traits\Useful_Variables;
use WP_Query;

/**
 * SSP Episode Controller
 *
 * @package Seriously Simple Podcasting
 *
 * @deprecated Almost all episode-related functions now in Episode_Repository or Frontend_Controller.
 * So lets just get rid of this class.
 * @todo: move functions to Episode_Repository, rest - to Frontend Controller
 */
class Episode_Controller {

	use Useful_Variables;

	/**
	 * @var Renderer
	 * */
	public $renderer;

	/**
	 * @var Episode_Repository
	 * */
	public $episode_repository;

	/**
	 * @param Renderer $renderer
	 */
	public function __construct( $renderer ) {
		$this->init_useful_variables();

		$this->renderer = $renderer;
		$this->episode_repository = new Episode_Repository();
	}


	/**
	 * Get episode enclosure
	 *
	 * @param integer $episode_id ID of episode
	 *
	 * @return string              URL of enclosure
	 * @deprecated Use Episode_Repository::get_enclosure()
	 */
	public function get_enclosure( $episode_id = 0 ) {
		return $this->episode_repository->get_enclosure( $episode_id );
	}

	/**
	 * Get download link for episode
	 *
	 * @param $episode_id
	 * @param string $referrer
	 *
	 * @return string
	 * @deprecated Use Episode_Repository::get_episode_download_link()
	 */
	public function get_episode_download_link( $episode_id, $referrer = '' ) {
		return $this->episode_repository->get_episode_download_link( $episode_id, $referrer );
	}

	/**
	 * Get player link for episode.
	 *
	 * @param int $episode_id
	 *
	 * @return string
	 * @deprecated Use Episode_Repository::get_episode_player_link()
	 */
	public function get_episode_player_link( $episode_id ) {
		return $this->episode_repository->get_episode_player_link( $episode_id );
	}

	/**
	 * Get Album Art for Player
	 *
	 * Iteratively tries to find the correct album art based on whether the desired image is of square aspect ratio.
	 * Falls back to default album art if it can not find the correct ones.
	 *
	 * @param int $episode_id ID of the episode being loaded into the player
	 *
	 * @return array [ $src, $width, $height ]
	 *
	 * @since 1.19.4
	 *
	 * @deprecated Please use Episode_Repository::get_album_art()
	 */
	public function get_album_art( $episode_id = false, $size = 'full' ) {
		return $this->episode_repository->get_album_art( $episode_id, $size );
	}

	/**
	 * Get featured image src.
	 *
	 * @param int $episode_id ID of the episode.
	 *
	 * @return array|null [ $src, $width, $height ]
	 *
	 * @since 2.9.9
	 */
	public function get_featured_image_src( $episode_id, $size = 'full' ) {
		$thumb_id = get_post_thumbnail_id( $episode_id );
		if ( empty( $thumb_id ) ) {
			return null;
		}
		return ssp_get_attachment_image_src( $thumb_id, $size );
	}


	/**
	 * Get Episode List
	 *
	 * @param array $episode_ids , array of episode ids being loaded into the player
	 * @param $include_title
	 * @param $include_excerpt
	 * @param $include_player
	 * @param $include_subscribe_links
	 *
	 * @return array [ $src, $width, $height ]
	 *
	 * @since 2.2.3
	 */
	public function episode_list( $episode_ids, $include_title = false, $include_excerpt = false, $include_player = false, $include_subscribe_links = false ) {
		$episodes = null;

		if ( ! empty( $episode_ids ) ) {
			$args = array(
				'include'        => array_values( $episode_ids ),
				'post_type'      => SSP_CPT_PODCAST,
				'numberposts'    => -1
			);

			$episodes = get_posts( $args );
		}

		$episodes_template_data = array(
			'episodes'       => $episodes,
		);

		$episodes_template_data = apply_filters( 'episode_list_data', $episodes_template_data );

		return $this->renderer->render_deprecated( $episodes_template_data, 'episodes/episode-list' );
	}

	/**
	 * Render a list of all episodes, based on settings sent
	 * @todo, currently used for Elementor, update to use for the Block editor as well.
	 *
	 * @param $settings
	 *
	 * @return string
	 */
	public function render_episodes( $settings ) {
		global $ss_podcasting;
		$player = $ss_podcasting->players_controller;
		$paged  = get_query_var( 'paged' );

		$args = array(
			'post_type'      => SSP_CPT_PODCAST,
			'posts_per_page' => 10,
			'paged'          => $paged ?: 1,
		);

		$episodes               = new WP_Query( $args );
		$episodes_template_data = array(
			'player'   => $player,
			'episodes' => $episodes,
			'settings' => $settings,
		);

		$episodes_template_data = apply_filters( 'episode_list_data', $episodes_template_data );

		return $this->renderer->fetch( 'episodes/all-episodes-list', $episodes_template_data );
	}

	/**
	 * Gather a list of the last 3 episodes for the Elementor Recent Episodes Widget
	 *
	 * @param array $args {
	 *     Optional. Array or string of Query parameters.
	 *
	 *     @type int    $episodes_number Number of episodes. Default: 3.
	 *     @type string $episode_types   Episode types. Variants: all_podcast_types, podcast. Default: podcast.
	 *     @type string $order_by        Order by field. Variants: published, recorded. Default: published.
	 * }
	 *
	 * @return \WP_Post[]
	 */
	public function get_recent_episodes( $args = array() ) {
		return $this->episode_repository->get_recent_episodes( $args );
	}
}