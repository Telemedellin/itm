<?php

/* month.twig */
class __TwigTemplate_a54faca929c567a44d5e4e2e7cf06d45c14508bd3d07f5bdfb60a7ddce3ec07a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo (isset($context["navigation"]) ? $context["navigation"] : null);
        echo "

<table class=\"ai1ec-month-view ai1ec-popover-boundary
\t";
        // line 4
        if ((isset($context["month_word_wrap"]) ? $context["month_word_wrap"] : null)) {
            echo "ai1ec-word-wrap";
        }
        echo "\">
\t<thead>
\t\t<tr>
\t\t\t";
        // line 7
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["weekdays"]) ? $context["weekdays"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["weekday"]) {
            // line 8
            echo "\t\t\t\t<th scope=\"col\" class=\"ai1ec-weekday\">";
            echo twig_escape_filter($this->env, (isset($context["weekday"]) ? $context["weekday"] : null), "html", null, true);
            echo "</th>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['weekday'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "\t\t</tr>
\t</thead>
\t<tbody>
\t\t";
        // line 13
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["cell_array"]) ? $context["cell_array"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["week"]) {
            // line 14
            echo "\t\t\t";
            $context["added_stretcher"] = false;
            // line 15
            echo "\t\t\t<tr class=\"ai1ec-week\">
\t\t\t\t";
            // line 16
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["week"]) ? $context["week"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["day"]) {
                // line 17
                echo "
\t\t\t\t\t";
                // line 18
                if ($this->getAttribute((isset($context["day"]) ? $context["day"] : null), "date")) {
                    // line 19
                    echo "\t\t\t\t\t\t<td ";
                    if ($this->getAttribute((isset($context["day"]) ? $context["day"] : null), "today")) {
                        echo "class=\"ai1ec-today\"";
                    }
                    echo ">
\t\t\t\t\t\t\t";
                    // line 21
                    echo "\t\t\t\t\t\t\t";
                    if ((!(isset($context["added_stretcher"]) ? $context["added_stretcher"] : null))) {
                        // line 22
                        echo "\t\t\t\t\t\t\t\t<div class=\"ai1ec-day-stretcher\"></div>
\t\t\t\t\t\t\t\t";
                        // line 23
                        $context["added_stretcher"] = true;
                        // line 24
                        echo "\t\t\t\t\t\t\t";
                    }
                    // line 25
                    echo "
\t\t\t\t\t\t\t<div class=\"ai1ec-day\">
\t\t\t\t\t\t\t\t<div class=\"ai1ec-date\">
\t\t\t\t\t\t\t\t\t<a class=\"ai1ec-load-view\"
\t\t\t\t\t\t\t\t\t\t";
                    // line 29
                    echo (isset($context["data_type"]) ? $context["data_type"] : null);
                    echo "
\t\t\t\t\t\t\t\t\t\thref=\"";
                    // line 30
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["day"]) ? $context["day"] : null), "date_link"), "html_attr");
                    echo "\"
\t\t\t\t\t\t\t\t\t\t>";
                    // line 31
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["day"]) ? $context["day"] : null), "date"), "html", null, true);
                    echo "</a>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t";
                    // line 34
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["day"]) ? $context["day"] : null), "events"));
                    foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
                        // line 35
                        echo "\t\t\t\t\t\t\t\t\t<a href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "permalink"), "html_attr");
                        echo "\"
\t\t\t\t\t\t\t\t\t\t";
                        // line 36
                        if ($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "is_multiday")) {
                            // line 37
                            echo "\t\t\t\t\t\t\t\t\t\t\tdata-start-day=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "start_day"), "html", null, true);
                            echo "\"
\t\t\t\t\t\t\t\t\t\t\tdata-end-day=\"";
                            // line 38
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "multiday_end_day"), "html", null, true);
                            echo "\"
\t\t\t\t\t\t\t\t\t\t\tdata-start-truncated=\"";
                            // line 39
                            echo (($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "start_truncated")) ? ("true") : ("false"));
                            echo "\"
\t\t\t\t\t\t\t\t\t\t\tdata-end-truncated=\"";
                            // line 40
                            echo (($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "end_truncated")) ? ("true") : ("false"));
                            echo "\"
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 42
                        echo "\t\t\t\t\t\t\t\t\t\tdata-instance-id=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "instance_id"), "html", null, true);
                        echo "\"
\t\t\t\t\t\t\t\t\t\tclass=\"ai1ec-event-container ai1ec-load-event
\t\t\t\t\t\t\t\t\t\t\tai1ec-popup-trigger
\t\t\t\t\t\t\t\t\t\t\tai1ec-event-id-";
                        // line 45
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "post_id"), "html", null, true);
                        echo "
\t\t\t\t\t\t\t\t\t\t\tai1ec-event-instance-id-";
                        // line 46
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "instance_id"), "html", null, true);
                        echo "
\t\t\t\t\t\t\t\t\t\t\t";
                        // line 47
                        if ($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "is_allday")) {
                            echo "ai1ec-allday";
                        }
                        // line 48
                        echo "\t\t\t\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "is_multiday")) {
                            echo "ai1ec-multiday";
                        }
                        echo "\"
\t\t\t\t\t\t\t\t\t\t>

\t\t\t\t\t\t\t\t\t\t<div class=\"ai1ec-event\"
\t\t\t\t\t\t\t\t\t\t\t style=\"";
                        // line 52
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "color_style"), "html_attr");
                        echo "\">
\t\t\t\t\t\t\t\t\t\t\t<span class=\"ai1ec-event-title\">
\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 54
                        echo $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "filtered_title");
                        echo "
\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t\t";
                        // line 56
                        if ((!$this->getAttribute((isset($context["event"]) ? $context["event"] : null), "is_allday"))) {
                            // line 57
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"ai1ec-event-time\">
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                            // line 58
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "short_start_time"), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t\t</span>
\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 61
                        echo "\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</a>

\t\t\t\t\t\t\t\t\t<div class=\"ai1ec-popover ai1ec-popup ai1ec-popup-in-";
                        // line 64
                        echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : null), "html", null, true);
                        echo "-view
\t\t\t\t\t\t\t\t\t            ai1ec-event-id-";
                        // line 65
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "post_id"), "html", null, true);
                        echo "
\t\t\t\t\t\t\t\t\t            ai1ec-event-instance-id-";
                        // line 66
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "instance_id"), "html", null, true);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t";
                        // line 67
                        if ($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "category_colors")) {
                            // line 68
                            echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"ai1ec-color-swatches\">";
                            echo $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "category_colors");
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 70
                        echo "\t\t\t\t\t\t\t\t\t\t<span class=\"ai1ec-popup-title\">
\t\t\t\t\t\t\t\t\t\t\t<a class=\"ai1ec-load-event\"
\t\t\t\t\t\t\t\t\t\t\t\thref=\"";
                        // line 72
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "permalink"), "html_attr");
                        echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t>";
                        // line 73
                        echo $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "filtered_title");
                        echo "</a>
\t\t\t\t\t\t\t\t\t\t\t";
                        // line 74
                        if (((isset($context["show_location_in_title"]) ? $context["show_location_in_title"] : null) && $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "venue"))) {
                            // line 75
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"ai1ec-event-location\"
\t\t\t\t\t\t\t\t\t\t\t\t\t>";
                            // line 76
                            echo twig_escape_filter($this->env, sprintf((isset($context["text_venue_separator"]) ? $context["text_venue_separator"] : null), $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "venue")), "html", null, true);
                            echo "</span>
\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 78
                        echo "\t\t\t\t\t\t\t\t\t\t\t";
                        if (((isset($context["is_ticket_button_enabled"]) ? $context["is_ticket_button_enabled"] : null) && $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "ticket_url"))) {
                            // line 79
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"ai1ec-pull-right ai1ec-btn ai1ec-btn-primary ai1ec-btn-xs
\t\t\t\t\t\t\t\t\t\t\t\t\tai1ec-buy-tickets\" target=\"_blank\"
\t\t\t\t\t\t\t\t\t\t\t\t\thref=\"";
                            // line 81
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "ticket_url"), "html_attr");
                            echo "\"
\t\t\t\t\t\t\t\t\t\t\t\t\t>";
                            // line 82
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "ticket_url_label"), "html", null, true);
                            echo "</a>
\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 84
                        echo "\t\t\t\t\t\t\t\t\t\t</span>

\t\t\t\t\t\t\t\t\t\t";
                        // line 86
                        if ($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "edit_post_link")) {
                            // line 87
                            echo "\t\t\t\t\t\t\t\t\t\t\t<a class=\"post-edit-link\"
\t\t\t\t\t\t\t\t\t\t\t\thref=\"";
                            // line 88
                            echo $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "edit_post_link");
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"ai1ec-fa ai1ec-fa-pencil\"></i> ";
                            // line 89
                            echo twig_escape_filter($this->env, (isset($context["text_edit"]) ? $context["text_edit"] : null), "html", null, true);
                            echo "
\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 92
                        echo "
\t\t\t\t\t\t\t\t\t\t<div class=\"ai1ec-event-time\">
\t\t\t\t\t\t\t\t\t\t\t";
                        // line 94
                        echo $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "popup_timespan");
                        echo "
\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t<a class=\"ai1ec-load-event\"
\t\t\t\t\t\t\t\t\t\t\thref=\"";
                        // line 98
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "permalink"), "html_attr");
                        echo "\">
\t\t\t\t\t\t\t\t\t\t\t";
                        // line 99
                        echo $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "avatar_not_wrapped");
                        echo "
\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t";
                        // line 101
                        echo (isset($context["action_buttons"]) ? $context["action_buttons"] : null);
                        echo "

\t\t\t\t\t\t\t\t\t\t";
                        // line 103
                        if ($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "post_excerpt")) {
                            // line 104
                            echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"ai1ec-popup-excerpt\">";
                            echo $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "post_excerpt");
                            echo "</div>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 106
                        echo "\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 108
                    echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</td>
\t\t\t\t\t";
                } else {
                    // line 110
                    echo " ";
                    // line 111
                    echo "\t\t\t\t\t\t<td class=\"ai1ec-empty\"></td>
\t\t\t\t\t";
                }
                // line 112
                echo " ";
                // line 113
                echo "
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['day'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 114
            echo " ";
            // line 115
            echo "\t\t\t</tr>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['week'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 116
        echo " ";
        // line 117
        echo "\t</tbody>
</table>

<div class=\"ai1ec-pull-left\">";
        // line 120
        echo (isset($context["pagination_links"]) ? $context["pagination_links"] : null);
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "month.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  345 => 120,  340 => 117,  338 => 116,  331 => 115,  329 => 114,  322 => 113,  320 => 112,  316 => 111,  314 => 110,  309 => 108,  302 => 106,  296 => 104,  294 => 103,  289 => 101,  284 => 99,  280 => 98,  273 => 94,  269 => 92,  263 => 89,  259 => 88,  256 => 87,  254 => 86,  250 => 84,  245 => 82,  241 => 81,  237 => 79,  234 => 78,  229 => 76,  226 => 75,  224 => 74,  220 => 73,  216 => 72,  212 => 70,  206 => 68,  204 => 67,  200 => 66,  196 => 65,  192 => 64,  187 => 61,  181 => 58,  178 => 57,  176 => 56,  171 => 54,  166 => 52,  156 => 48,  152 => 47,  148 => 46,  144 => 45,  137 => 42,  132 => 40,  128 => 39,  124 => 38,  119 => 37,  117 => 36,  112 => 35,  108 => 34,  102 => 31,  98 => 30,  94 => 29,  88 => 25,  85 => 24,  83 => 23,  80 => 22,  77 => 21,  70 => 19,  68 => 18,  65 => 17,  61 => 16,  58 => 15,  55 => 14,  51 => 13,  46 => 10,  37 => 8,  33 => 7,  25 => 4,  19 => 1,);
    }
}
