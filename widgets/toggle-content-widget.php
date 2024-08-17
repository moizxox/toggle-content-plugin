<!-- This is rough comment -->

<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Elementor_Toggle_Content_Widget extends Widget_Base {

    public function get_name() {
        return 'toggle_content_widget';
    }

    public function get_title() {
        return __('Toggle Content', 'plugin-name');
    }

    public function get_icon() {
        return 'eicon-toggle';
    }

    public function get_categories() {
        return ['basic'];
    }

  protected function _register_controls() {
    $this->start_controls_section(
        'content_section',
        [
            'label' => __('Content', 'plugin-name'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'heading',
        [
            'label' => __('Heading', 'plugin-name'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Lorem ipsum dolor sit amet.', 'plugin-name'),
        ]
    );

    $this->add_control(
        'residential_button_text',
        [
            'label' => __('Residential Button Text', 'plugin-name'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Residential', 'plugin-name'),
        ]
    );

    $this->add_control(
        'commercial_button_text',
        [
            'label' => __('Commercial Button Text', 'plugin-name'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Commercial', 'plugin-name'),
        ]
    );

    $this->add_control(
        'residential_content',
        [
            'label' => __('Residential Content', 'plugin-name'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => __('Content for Residential', 'plugin-name'),
        ]
    );

    $this->add_control(
        'commercial_content',
        [
            'label' => __('Commercial Content', 'plugin-name'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => __('Content for Commercial', 'plugin-name'),
        ]
    );

    $this->end_controls_section();

    // Separate Tab for Heading Styles
    $this->start_controls_section(
        'heading_style_section',
        [
            'label' => __('Heading', 'plugin-name'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    // Typography control for h2
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'heading_typography',
            'label' => __('Heading Typography', 'plugin-name'),
            'selector' => '{{WRAPPER}} .head-toggle-left h2',
        ]
    );

    // Text color control for h2
    $this->add_control(
        'heading_text_color',
        [
            'label' => __('Heading Text Color', 'plugin-name'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .head-toggle-left h2' => 'color: {{VALUE}};',
            ],
        ]
    );

    // Width control for h2
    $this->add_responsive_control(
        'heading_width',
        [
            'label' => __('Heading Width', 'plugin-name'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['%', 'px'],
            'range' => [
                '%' => [
                    'min' => 10,
                    'max' => 100,
                ],
                'px' => [
                    'min' => 50,
                    'max' => 1200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .head-toggle-left h2' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

    // Separate Tab for Button Styles
    $this->start_controls_section(
        'button_style_section',
        [
            'label' => __('Buttons', 'plugin-name'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'toggle_button_group_background',
        [
            'label' => __('Toggle Button Group Background', 'plugin-name'),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .toggle-button-group' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    // Typography control for .toggle-button
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'toggle_button_typography',
            'label' => __('Toggle Button Typography', 'plugin-name'),
            'selector' => '{{WRAPPER}} .toggle-button',
        ]
    );

    // Text color control for .toggle-button
    $this->add_control(
        'toggle_button_text_color',
        [
            'label' => __('Toggle Button Text Color', 'plugin-name'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .toggle-button' => 'color: {{VALUE}};',
            ],
        ]
    );

    // Background color control for .toggle-button.active
    $this->add_control(
        'toggle_button_active_background',
        [
            'label' => __('Active Toggle Button Background', 'plugin-name'),
            'type' => Controls_Manager::COLOR,
            'default' => '#800080',
            'selectors' => [
                '{{WRAPPER}} .toggle-button.active' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    // Text color control for .toggle-button.active
    $this->add_control(
        'toggle_button_active_text_color',
        [
            'label' => __('Active Toggle Button Text Color', 'plugin-name'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .toggle-button.active' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_section();
}




    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
        .toggle-cont {
          width: auto;
          margin: 0 auto;
          padding: 20px;
          box-sizing: border-box;
        }

        .head-toggle {
          display: flex;
          justify-content: space-between;
          align-items: flex-start;
          margin-bottom: 20px;
        }

        .head-toggle-left h2 {
          margin: 0;
          font-size: 40px;
          line-height: 40px;
          width: 100%;
        }

        .head-toggle-right {
          display: flex;
          align-items: center;
        }

        .toggle-button-group {
          display: flex;
          background-color: black;
          justify-content: space-between;
          padding: 5px;
          border-radius: 10px;
          gap: 10px;
        }

        .toggle-button {
          flex: 1;
          background-color: transparent;
          color: white;
          border: none;
          cursor: pointer;
          font-size: 20px;
          text-align: center;
          outline: none;
          transition: background-color 0.3s ease-in-out;
          border-radius: 10px;
          text-transform: uppercase;
          padding: 15px 20px;
        }

        .toggle-button.active {
          background-color: purple;
        }

        .toggle-content {
          width: 100%;
        }

        .toggle-content-item {
          display: none;
          width: 100%;
        }

        .toggle-content-item.active {
          display: block;
        }
        g
        </style>
        <div class="toggle-cont">
            <div class="head-toggle">
                <div class="head-toggle-left">
                    <h2><?php echo $settings['heading']; ?></h2>
                </div>
                <div class="head-toggle-right">
                    <div class="toggle-button-group">
                    <button class="toggle-button active" data-target="residential-content">
                        <?php echo $settings['residential_button_text']; ?>
                    </button>
                    <button class="toggle-button" data-target="commercial-content">
                        <?php echo $settings['commercial_button_text']; ?>
                    </button>
                </div>
                </div>
            </div>

            <div class="toggle-content">
                <div class="toggle-content-item residential-content active">
                    <?php echo $settings['residential_content']; ?>
                </div>
                <div class="toggle-content-item commercial-content">
                    <?php echo $settings['commercial_content']; ?>
                </div>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-button');
            const contentItems = document.querySelectorAll('.toggle-content-item');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons and content items
                    toggleButtons.forEach(btn => btn.classList.remove('active'));
                    contentItems.forEach(item => item.classList.remove('active'));

                    // Add active class to the clicked button and the corresponding content item
                    this.classList.add('active');
                    document.querySelector(`.${this.getAttribute('data-target')}`).classList.add('active');
                });
            });
        });
        </script>
        <?php
    }

    protected function _content_template() {
      ?>
      <#
      var heading = settings.heading;
      var residentialButtonText = settings.residential_button_text;
      var commercialButtonText = settings.commercial_button_text;
      var residentialContent = settings.residential_content;
      var commercialContent = settings.commercial_content;
      var toggleButtonGroupBgColor = settings.toggle_button_group_background;
      var toggleButtonActiveBgColor = settings.toggle_button_active_background;
      var toggleButtonTextColor = settings.toggle_button_text_color;
      var toggleButtonActiveTextColor = settings.toggle_button_active_text_color;
      #>
      <style>
      .toggle-cont {
          width: 100%;
          max-width: 1280px;
          margin: 0 auto;
          padding: 20px;
          box-sizing: border-box;
      }
    
      .head-toggle {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 20px;
      }
    
      .head-toggle-left h2 {
          margin: 0;
          font-size: 40px;
          line-height: 40px;
          width: {{{ settings.heading_width.size }}}{{ settings.heading_width.unit }};
          color: {{{ settings.heading_text_color }}};
          {{{ settings.heading_typography }}}
      }
    
      .head-toggle-right {
          display: flex;
          align-items: center;
      }
    
      .toggle-button-group {
          display: flex;
          background-color: {{{ toggleButtonGroupBgColor }}};
          justify-content: space-between;
          padding: 5px;
          border-radius: 10px;
          gap: 10px;
      }
    
      .toggle-button {
          flex: 1;
          background-color: transparent;
          color: {{{ toggleButtonTextColor }}};
          border: none;
          cursor: pointer;
          font-size: 20px;
          text-align: center;
          outline: none;
          transition: background-color 0.3s ease-in-out;
          border-radius: 10px;
          text-transform: uppercase;
          padding: 15px 20px;
      }
    
      .toggle-button.active {
          background-color: {{{ toggleButtonActiveBgColor }}};
          color: {{{ toggleButtonActiveTextColor }}};
      }
    
      .toggle-content {
          width: 100%;
      }
    
      .toggle-content-item {
          display: none;
          width: 100%;
      }
    
      .toggle-content-item.active {
          display: block;
      }
      </style>
      <div class="toggle-cont">
          <div class="head-toggle">
              <div class="head-toggle-left">
                  <h2>{{{ heading }}}</h2>
              </div>
              <div class="head-toggle-right">
                  <div class="toggle-button-group">
                      <button class="toggle-button active" data-target="residential-content">
                          {{{ residentialButtonText }}}
                      </button>
                      <button class="toggle-button" data-target="commercial-content">
                          {{{ commercialButtonText }}}
                      </button>
                  </div>
              </div>
          </div>
    
          <div class="toggle-content">
              <div class="toggle-content-item residential-content active">
                  {{{ residentialContent }}}
              </div>
              <div class="toggle-content-item commercial-content">
                  {{{ commercialContent }}}
              </div>
          </div>
      </div>
    
      <script>
      document.addEventListener('DOMContentLoaded', function() {
          const toggleButtons = document.querySelectorAll('.toggle-button');
          const contentItems = document.querySelectorAll('.toggle-content-item');
    
          toggleButtons.forEach(button => {
              button.addEventListener('click', function() {
                  // Remove active class from all buttons and content items
                  toggleButtons.forEach(btn => btn.classList.remove('active'));
                  contentItems.forEach(item => item.classList.remove('active'));
    
                  // Add active class to the clicked button and the corresponding content item
                  this.classList.add('active');
                  document.querySelector(`.${this.getAttribute('data-target')}`).classList.add('active');
              });
          });
      });
      </script>
      <?php
    }
    
}