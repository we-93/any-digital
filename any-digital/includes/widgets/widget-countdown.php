<?php
/**
 * Any Digital - Countdown Timer Widget for Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access prevention
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

class AnyDigital_Widget_Countdown extends Widget_Base {

	public function get_name() {
		return 'any-digital-countdown';
	}

	public function get_title() {
		return __( 'Countdown Timer', 'any-digital' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_categories() {
		return [ 'any-digital' ];
	}

	public function get_keywords() {
		return [ 'countdown', 'timer', 'hitung mundur', 'waktu', 'any digital' ];
	}

	protected function register_controls() {

		/* -------------------------------------------------------------------------- */
		/*                              CONTENT SECTION                               */
		/* -------------------------------------------------------------------------- */
		$this->start_controls_section(
			'section_countdown_settings',
			[
				'label' => __( 'Pengaturan Countdown', 'any-digital' ),
			]
		);

		$this->add_control(
			'due_date',
			[
				'label'       => __( 'Tanggal & Waktu Target', 'any-digital' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date( 'Y-m-d H:i', strtotime( '+ 30 days' ) ),
				'description' => __( 'Tentukan tanggal dan waktu tujuan hitung mundur', 'any-digital' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_view',
			[
				'label'   => __( 'Posisi Label', 'any-digital' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block'  => __( 'Block (Bawah Angka)', 'any-digital' ),
					'inline' => __( 'Inline (Samping Angka)', 'any-digital' ),
				],
			]
		);

		$this->add_control(
			'show_days',
			[
				'label'        => __( 'Tampilkan Hari', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'label_days',
			[
				'label'     => __( 'Label Hari', 'any-digital' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Hari', 'any-digital' ),
				'condition' => [ 'show_days' => 'yes' ],
				'dynamic'   => [ 'active' => true ],
			]
		);

		$this->add_control(
			'show_hours',
			[
				'label'        => __( 'Tampilkan Jam', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'label_hours',
			[
				'label'     => __( 'Label Jam', 'any-digital' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Jam', 'any-digital' ),
				'condition' => [ 'show_hours' => 'yes' ],
				'dynamic'   => [ 'active' => true ],
			]
		);

		$this->add_control(
			'show_minutes',
			[
				'label'        => __( 'Tampilkan Menit', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'label_minutes',
			[
				'label'     => __( 'Label Menit', 'any-digital' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Menit', 'any-digital' ),
				'condition' => [ 'show_minutes' => 'yes' ],
				'dynamic'   => [ 'active' => true ],
			]
		);

		$this->add_control(
			'show_seconds',
			[
				'label'        => __( 'Tampilkan Detik', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'label_seconds',
			[
				'label'     => __( 'Label Detik', 'any-digital' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Detik', 'any-digital' ),
				'condition' => [ 'show_seconds' => 'yes' ],
				'dynamic'   => [ 'active' => true ],
			]
		);

		$this->add_control(
			'show_separator',
			[
				'label'        => __( 'Tampilkan Separator ( : )', 'any-digital' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$this->end_controls_section();

		/* -------------------------------------------------------------------------- */
		/*                              STYLE SECTIONS                                */
		/* -------------------------------------------------------------------------- */

		// STYLE: Box Item
		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Kotak Item (Box)', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding Box', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-countdown-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg',
				'label'    => __( 'Background Box', 'any-digital' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .any-digital-countdown-item-inner',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Border Box', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-countdown-item-inner',
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'any-digital' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-countdown-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-countdown-item-inner',
			]
		);

		$this->add_responsive_control(
			'box_gap',
			[
				'label'      => __( 'Jarak Antar Kotak', 'any-digital' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 50 ],
				],
				'default'    => [ 'size' => 10, 'unit' => 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .any-digital-countdown-items' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE: Angka (Digits)
		$this->start_controls_section(
			'section_digits_style',
			[
				'label' => __( 'Angka (Digits)', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'digits_color',
			[
				'label'     => __( 'Warna Angka', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .any-digital-countdown-digits' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'digits_typography',
				'label'    => __( 'Tipografi Angka', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-countdown-digits',
			]
		);

		$this->end_controls_section();

		// STYLE: Label Teks (Hari, Jam, Menit, Detik)
		$this->start_controls_section(
			'section_labels_style',
			[
				'label' => __( 'Label Teks', 'any-digital' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label'     => __( 'Warna Label', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666666',
				'selectors' => [
					'{{WRAPPER}} .any-digital-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'labels_typography',
				'label'    => __( 'Tipografi Label', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-countdown-label',
			]
		);

		$this->end_controls_section();

		// STYLE: Separator ( : )
		$this->start_controls_section(
			'section_separator_style',
			[
				'label'     => __( 'Separator ( : )', 'any-digital' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_separator' => 'yes' ],
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'     => __( 'Warna Separator', 'any-digital' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .any-digital-countdown-separator' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'separator_typography',
				'label'    => __( 'Tipografi Separator', 'any-digital' ),
				'selector' => '{{WRAPPER}} .any-digital-countdown-separator',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$due_date_str = ! empty( $settings['due_date'] ) ? $settings['due_date'] : date( 'Y-m-d H:i', strtotime( '+ 30 days' ) );
		$target_time  = date( 'M d Y H:i:s', strtotime( $due_date_str ) );

		$label_view_class = ( 'inline' === $settings['label_view'] ) ? 'any-digital-countdown-inline' : 'any-digital-countdown-block';
		$show_sep         = ( 'yes' === $settings['show_separator'] );
		?>

		<div class="any-digital-countdown-wrapper">
			<ul class="any-digital-countdown-items <?php echo esc_attr( $label_view_class ); ?>" data-date="<?php echo esc_attr( $target_time ); ?>">
				
				<?php if ( 'yes' === $settings['show_days'] ) : ?>
					<li class="any-digital-countdown-item">
						<div class="any-digital-countdown-item-inner">
							<span data-days class="any-digital-countdown-digits">00</span>
							<?php if ( ! empty( $settings['label_days'] ) ) : ?>
								<span class="any-digital-countdown-label"><?php echo esc_html( $settings['label_days'] ); ?></span>
							<?php endif; ?>
						</div>
					</li>
					<?php if ( $show_sep && ( 'yes' === $settings['show_hours'] || 'yes' === $settings['show_minutes'] || 'yes' === $settings['show_seconds'] ) ) : ?>
						<li class="any-digital-countdown-separator">:</li>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_hours'] ) : ?>
					<li class="any-digital-countdown-item">
						<div class="any-digital-countdown-item-inner">
							<span data-hours class="any-digital-countdown-digits">00</span>
							<?php if ( ! empty( $settings['label_hours'] ) ) : ?>
								<span class="any-digital-countdown-label"><?php echo esc_html( $settings['label_hours'] ); ?></span>
							<?php endif; ?>
						</div>
					</li>
					<?php if ( $show_sep && ( 'yes' === $settings['show_minutes'] || 'yes' === $settings['show_seconds'] ) ) : ?>
						<li class="any-digital-countdown-separator">:</li>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_minutes'] ) : ?>
					<li class="any-digital-countdown-item">
						<div class="any-digital-countdown-item-inner">
							<span data-minutes class="any-digital-countdown-digits">00</span>
							<?php if ( ! empty( $settings['label_minutes'] ) ) : ?>
								<span class="any-digital-countdown-label"><?php echo esc_html( $settings['label_minutes'] ); ?></span>
							<?php endif; ?>
						</div>
					</li>
					<?php if ( $show_sep && 'yes' === $settings['show_seconds'] ) : ?>
						<li class="any-digital-countdown-separator">:</li>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( 'yes' === $settings['show_seconds'] ) : ?>
					<li class="any-digital-countdown-item">
						<div class="any-digital-countdown-item-inner">
							<span data-seconds class="any-digital-countdown-digits">00</span>
							<?php if ( ! empty( $settings['label_seconds'] ) ) : ?>
								<span class="any-digital-countdown-label"><?php echo esc_html( $settings['label_seconds'] ); ?></span>
							<?php endif; ?>
						</div>
					</li>
				<?php endif; ?>

			</ul>
		</div>

		<?php
	}
}
