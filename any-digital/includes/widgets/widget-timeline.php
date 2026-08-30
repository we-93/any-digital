<?php
/**
 * Any Digital - Timeline Story Widget for Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access prevention
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

class AnyDigital_Widget_Timeline extends Widget_Base {

	public function get_name() {
		return 'any-digital-timeline';
	}

	public function get_title() {
		return __( 'Timeline Story', 'any-digital' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_categories() {
		return [ 'any-digital' ];
	}

	public function get_keywords() {
		return [ 'timeline', 'story', 'perjalanan', 'kisah', 'any digital' ];
	}

	protected function register_controls() {

		/* -------------------------------------------------------------------------- */
		/*                              LAYOUT SECTION                                */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Pengaturan Layout Timeline', 'any-digital' ),
			]
		);

		$this->add_control(
			'timeline_align',
			[
				'label'   => __( 'Posisi Garis Timeline', 'any-digital' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left'   => [
						'title' => __( 'Kiri', 'any-digital' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Tengah', 'any-digital' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Kanan', 'any-digital' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              CONTENT REPEATER                              */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Daftar Cerita (Timeline Items)', 'any-digital' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'twae_story_title',
			[
				'label'       => __( 'Judul Cerita', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Pertama Kali Bertemu', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'twae_date_label',
			[
				'label'       => __( 'Tanggal / Waktu', 'any-digital' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '12 Januari 2020', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'twae_description',
			[
				'label'       => __( 'Deskripsi Cerita', 'any-digital' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => __( 'Awal mula kami saling mengenal dan memulai perjalanan bersama.', 'any-digital' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'timeline_image',
			[
				'label'   => __( 'Foto / Gambar (Opsional)', 'any-digital' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [ 'url' => '' ],
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'twae_story_icon',
			[
				'label'       => __( 'Ikon Marker', 'any-digital' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'fas fa-heart',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'timeline_items',
			[
				'label'       => __( 'Timeline Story List', 'any-digital' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'twae_story_title' => __( 'Pertama Kali Bertemu', 'any-digital' ),
						'twae_date_label'  => __( '12 Januari 2020', 'any-digital' ),
						'twae_description' => __( 'Awal mula pertemuan manis yang tidak pernah diduga sebelumnya.', 'any-digital' ),
					],
					[
						'twae_story_title' => __( 'Momen Lamaran', 'any-digital' ),
						'twae_date_label'  => __( '15 Agustus 2025', 'any-digital' ),
						'twae_description' => __( 'Memutuskan untuk melangkah ke jenjang yang lebih serius bersama keluarga.', 'any-digital' ),
					],
					[
						'twae_story_title' => __( 'Hari Pernikahan', 'any-digital' ),
						'twae_date_label'  => __( '31 Desember 2026', 'any-digital' ),
						'twae_description' => __( 'Mengikat janji suci dan memulai lembaran baru dalam ikatan pernikahan.', 'any-digital' ),
					],
				],
				'title_field' => '{{{ twae_story_title }}}',
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              STYLE SECTIONS                                */
		/* -------------------------------------------------------------------------- */

		// STYLE: Line & Marker Icon
		$this->start_controls_section(
			'section_style_line',
			[
				'label' => __( 'Garis & Ikon Marker', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'line_color',
			[
				'label'     => __( 'Warna Garis Timeline', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c89556',
				'selectors' => [
					'{{WRAPPER}} .any-digital-timeline-line' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'marker_bg_color',
			[
				'label'     => __( 'Warna Background Marker', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c89556',
				'selectors' => [
					'{{WRAPPER}} .any-digital-timeline-marker' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'marker_icon_color',
			[
				'label'     => __( 'Warna Ikon Marker', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .any-digital-timeline-marker' => 'color: {{VALUE}};',
					'{{WRAPPER}} .any-digital-timeline-marker svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Card Cerita
		$this->start_controls_section(
			'section_style_card',
			[
				'label' => __( 'Kartu Cerita (Card)', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'card_bg',
				'label'    => __( 'Background Card', 'any-digital' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .any-digital-timeline-card',
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label'      => __( 'Padding Card', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-timeline-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'card_border',
				'label'    => __( 'Border Card', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-timeline-card',
			]
		);

		$this->add_responsive_control(
			'card_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-timeline-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'card_box_shadow',
				'label'    => __( 'Box Shadow', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-timeline-card',
			]
		);

		$this->end_controls_section();

		// STYLE: Tipografi Teks Cerita
		$this->start_controls_section(
			'section_style_typography',
			[
				'label' => __( 'Tipografi Teks', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Date
		$this->add_control(
			'heading_date_style',
			[
				'label'     => __( 'Tanggal / Waktu', 'any-digital' ),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => __( 'Warna Tanggal', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c89556',
				'selectors' => [
					'{{WRAPPER}} .any-digital-timeline-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'label'    => __( 'Tipografi Tanggal', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-timeline-date',
			]
		);

		// Title
		$this->add_control(
			'heading_title_style',
			[
				'label'     => __( 'Judul Cerita', 'any-digital' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Warna Judul', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .any-digital-timeline-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Tipografi Judul', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-timeline-title',
			]
		);

		// Description
		$this->add_control(
			'heading_desc_style',
			[
				'label'     => __( 'Deskripsi Cerita', 'any-digital' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => __( 'Warna Deskripsi', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666666',
				'selectors' => [
					'{{WRAPPER}} .any-digital-timeline-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'label'    => __( 'Tipografi Deskripsi', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-timeline-desc',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = ! empty( $settings['timeline_items'] ) ? $settings['timeline_items'] : [];
		$align    = ! empty( $settings['timeline_align'] ) ? $settings['timeline_align'] : 'center';

		if ( empty( $items ) ) return;
		?>

		<div class="any-digital-timeline-wrapper align-<?php echo esc_attr( $align ); ?>">
			<div class="any-digital-timeline-line"></div>
			<div class="any-digital-timeline-container">
				
				<?php
				$count = 0;
				foreach ( $items as $index => $item ) :
					$count++;
					$side_class = ( 0 === $count % 2 ) ? 'even-item' : 'odd-item';
					$title      = ! empty( $item['twae_story_title'] ) ? $item['twae_story_title'] : '';
					$date       = ! empty( $item['twae_date_label'] ) ? $item['twae_date_label'] : '';
					$desc       = ! empty( $item['twae_description'] ) ? $item['twae_description'] : '';
					$image_url  = ! empty( $item['timeline_image']['url'] ) ? $item['timeline_image']['url'] : '';
					?>
					
					<div class="any-digital-timeline-item <?php echo esc_attr( $side_class ); ?>">
						<div class="any-digital-timeline-marker">
							<?php if ( ! empty( $item['twae_story_icon']['value'] ) ) : ?>
								<?php Icons_Manager::render_icon( $item['twae_story_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							<?php else : ?>
								<i class="fas fa-heart" aria-hidden="true"></i>
							<?php endif; ?>
						</div>

						<div class="any-digital-timeline-card">
							<?php if ( ! empty( $date ) ) : ?>
								<div class="any-digital-timeline-date"><?php echo esc_html( $date ); ?></div>
							<?php endif; ?>

							<?php if ( ! empty( $title ) ) : ?>
								<h4 class="any-digital-timeline-title"><?php echo esc_html( $title ); ?></h4>
							<?php endif; ?>

							<?php if ( ! empty( $image_url ) ) : ?>
								<div class="any-digital-timeline-img">
									<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $desc ) ) : ?>
								<div class="any-digital-timeline-desc"><?php echo wp_kses_post( nl2br( $desc ) ); ?></div>
							<?php endif; ?>
						</div>
					</div>

				<?php endforeach; ?>

			</div>
		</div>

		<?php
	}
}
