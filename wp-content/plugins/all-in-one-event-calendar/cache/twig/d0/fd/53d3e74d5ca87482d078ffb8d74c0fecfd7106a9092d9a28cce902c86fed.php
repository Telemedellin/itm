<?php

/* event-single.twig */
class __TwigTemplate_d0fd53d3e74d5ca87482d078ffb8d74c0fecfd7106a9092d9a28cce902c86fed extends Twig_Template
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
        echo "<div class=\"timely ai1ec-single-event
\tai1ec-event-id-";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["post_id"]) ? $context["post_id"] : null), "html", null, true);
        echo "
\tai1ec-event-instance-id-";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["instance_id"]) ? $context["instance_id"] : null), "html", null, true);
        echo "
\t";
        // line 4
        if ($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "is_multiday")) {
            echo "ai1ec-multiday";
        }
        // line 5
        echo "\t";
        if ($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "is_allday")) {
            echo "ai1ec-allday";
        }
        echo "\">

<a id=\"ai1ec-event\"></a>

";
        // line 9
        if ((!(isset($context["hide_featured_image"]) ? $context["hide_featured_image"] : null))) {
            // line 10
            echo "\t";
            if (twig_test_empty((isset($context["content_img_url"]) ? $context["content_img_url"] : null))) {
                // line 11
                echo "\t\t";
                echo $this->env->getExtension('ai1ec')->avatar((isset($context["event"]) ? $context["event"] : null), array(0 => "post_thumbnail", 1 => "location_avatar", 2 => "category_avatar"), "timely", false);
                // line 15
                echo "
\t";
            }
        }
        // line 18
        echo "
<div class=\"ai1ec-actions\">
\t<div class=\"ai1ec-btn-group-vertical ai1ec-clearfix\">
\t\t";
        // line 21
        echo (isset($context["back_to_calendar"]) ? $context["back_to_calendar"] : null);
        echo "
\t</div>

\t<div class=\"ai1ec-btn-group-vertical ai1ec-clearfix\">
\t\t";
        // line 25
        if ((!twig_test_empty((isset($context["ticket_url"]) ? $context["ticket_url"] : null)))) {
            // line 26
            echo "\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, (isset($context["ticket_url"]) ? $context["ticket_url"] : null), "html_attr");
            echo "\" target=\"_blank\"
\t\t\t\tclass=\"ai1ec-tickets ai1ec-btn ai1ec-btn-sm ai1ec-btn-primary
\t\t\t\t\tai1ec-tooltip-trigger\"
\t\t\t\t\ttitle=\"";
            // line 29
            echo twig_escape_filter($this->env, (isset($context["tickets_url_label"]) ? $context["tickets_url_label"] : null), "html_attr");
            echo "\"
\t\t\t\t\tdata-placement=\"left\">
\t\t\t\t<i class=\"ai1ec-fa ai1ec-fa-ticket ai1ec-fa-fw\"></i>
\t\t\t\t<span class=\"ai1ec-hidden-xs\">
\t\t\t\t\t";
            // line 33
            echo twig_escape_filter($this->env, (isset($context["tickets_url_label"]) ? $context["tickets_url_label"] : null), "html", null, true);
            echo "
\t\t\t\t</span>
\t\t\t</a>
\t\t";
        }
        // line 37
        echo "\t\t";
        if ((isset($context["show_subscribe_buttons"]) ? $context["show_subscribe_buttons"] : null)) {
            // line 38
            echo "\t\t\t";
            $this->env->loadTemplate("subscribe-buttons.twig")->display(array_merge($context, array("export_url" => (isset($context["subscribe_url"]) ? $context["subscribe_url"] : null), "export_url_no_html" => (isset($context["subscribe_url_no_html"]) ? $context["subscribe_url_no_html"] : null), "subscribe_label" => (isset($context["text_add_calendar"]) ? $context["text_add_calendar"] : null), "text" => (isset($context["subscribe_buttons_text"]) ? $context["subscribe_buttons_text"] : null))));
            // line 44
            echo "\t\t";
        }
        // line 45
        echo "\t</div>

\t";
        // line 47
        if ((isset($context["extra_buttons"]) ? $context["extra_buttons"] : null)) {
            // line 48
            echo "\t\t";
            echo (isset($context["extra_buttons"]) ? $context["extra_buttons"] : null);
            echo "
\t";
        }
        // line 50
        echo "</div>

";
        // line 52
        if (twig_test_empty((isset($context["map"]) ? $context["map"] : null))) {
            // line 53
            echo "\t";
            $context["col1"] = "ai1ec-col-sm-3";
            // line 54
            echo "\t";
            $context["col2"] = "ai1ec-col-sm-9";
            // line 55
            echo "\t<div class=\"ai1ec-event-details ai1ec-clearfix\">
";
        } else {
            // line 57
            echo "\t";
            $context["col1"] = "ai1ec-col-sm-4 ai1ec-col-md-5";
            // line 58
            echo "\t";
            $context["col2"] = "ai1ec-col-sm-8 ai1ec-col-md-7";
            // line 59
            echo "\t<div class=\"ai1ec-event-details ai1ec-row\">
\t\t<div class=\"ai1ec-map ai1ec-col-sm-5 ai1ec-col-sm-push-7\">
\t\t\t";
            // line 61
            echo (isset($context["map"]) ? $context["map"] : null);
            echo "
\t\t</div>
\t\t<div class=\"ai1ec-col-sm-7 ai1ec-col-sm-pull-5\">
";
        }
        // line 65
        echo "
\t<div class=\"ai1ec-time ai1ec-row\">
\t\t<div class=\"ai1ec-field-label ";
        // line 67
        echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["text_when"]) ? $context["text_when"] : null), "html", null, true);
        echo "</div>
\t\t<div class=\"ai1ec-field-value ";
        // line 68
        echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
        echo " dt-duration\">
\t\t\t";
        // line 69
        echo $this->env->getExtension('ai1ec')->timespan((isset($context["event"]) ? $context["event"] : null));
        echo "
\t\t\t";
        // line 70
        if ($this->getAttribute((isset($context["timezone_info"]) ? $context["timezone_info"] : null), "show_timezone")) {
            // line 71
            echo "\t\t\t<abbr class=\"ai1ec-initialism ai1ec-tooltip-trigger\"
\t\t\t\ttitle=\"";
            // line 72
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["timezone_info"]) ? $context["timezone_info"] : null), "text_timezone_title"), "html_attr");
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["timezone_info"]) ? $context["timezone_info"] : null), "event_timezone"), "html", null, true);
            echo "</abbr>
\t\t\t";
        }
        // line 74
        echo "\t\t\t";
        $this->env->loadTemplate("recurrence.twig")->display($context);
        // line 75
        echo "\t\t</div>
\t\t<div class=\"ai1ec-hidden dt-start\">";
        // line 76
        echo twig_escape_filter($this->env, (isset($context["start"]) ? $context["start"] : null), "html", null, true);
        echo "</div>
\t\t<div class=\"ai1ec-hidden dt-end\">";
        // line 77
        echo twig_escape_filter($this->env, (isset($context["end"]) ? $context["end"] : null), "html", null, true);
        echo "</div>
\t</div>

\t";
        // line 80
        if ((!twig_test_empty((isset($context["location"]) ? $context["location"] : null)))) {
            // line 81
            echo "\t\t<div class=\"ai1ec-location ai1ec-row\">
\t\t\t<div class=\"ai1ec-field-label ";
            // line 82
            echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["text_where"]) ? $context["text_where"] : null), "html", null, true);
            echo "</div>
\t\t\t<div class=\"ai1ec-field-value ";
            // line 83
            echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
            echo " p-location\">
\t\t\t\t";
            // line 84
            echo (isset($context["location"]) ? $context["location"] : null);
            echo "
\t\t\t</div>
\t\t</div>
\t";
        }
        // line 88
        echo "
\t";
        // line 89
        if (((!twig_test_empty((isset($context["cost"]) ? $context["cost"] : null))) || $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "is_free"))) {
            // line 90
            echo "\t\t<div class=\"ai1ec-cost ai1ec-row\">
\t\t\t<div class=\"ai1ec-field-label ";
            // line 91
            echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["text_cost"]) ? $context["text_cost"] : null), "html", null, true);
            echo "</div>
\t\t\t<div class=\"ai1ec-field-value ";
            // line 92
            echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
            echo "\">
\t\t\t\t";
            // line 93
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["event"]) ? $context["event"] : null), "is_free")) ? ((isset($context["text_free"]) ? $context["text_free"] : null)) : ((isset($context["cost"]) ? $context["cost"] : null))), "html", null, true);
            echo "
\t\t\t</div>
\t\t</div>
\t";
        }
        // line 97
        echo "
\t";
        // line 98
        if ((!twig_test_empty((isset($context["tickets"]) ? $context["tickets"] : null)))) {
            // line 99
            echo "\t\t<div class=\"ai1ec-cost ai1ec-row\">
\t\t\t<div class=\"ai1ec-field-label ";
            // line 100
            echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
            echo "\">
\t\t\t\t";
            // line 101
            echo twig_escape_filter($this->env, (isset($context["text_tickets"]) ? $context["text_tickets"] : null), "html", null, true);
            echo "
\t\t\t</div>
\t\t\t<div class=\"ai1ec-field-value ";
            // line 103
            echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
            echo "\">
\t\t\t\t<form action=\"";
            // line 104
            echo twig_escape_filter($this->env, (isset($context["tickets_checkout_url"]) ? $context["tickets_checkout_url"] : null), "html", null, true);
            echo "\" method=\"GET\" target=\"_blank\">
\t\t\t\t\t<input type=\"hidden\" name=\"event_id\" value=\"";
            // line 105
            echo twig_escape_filter($this->env, (isset($context["api_event_id"]) ? $context["api_event_id"] : null), "html", null, true);
            echo "\">
\t\t\t\t\t<table>
\t\t\t\t\t<tbody>
\t\t\t\t\t";
            // line 108
            $context["ticket_count"] = 0;
            // line 109
            echo "\t\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["tickets"]) ? $context["tickets"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ticket"]) {
                // line 110
                echo "\t\t\t\t\t\t";
                if (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "status") != "hidden")) {
                    // line 111
                    echo "\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t";
                    // line 112
                    if (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "availability") == null)) {
                        // line 113
                        echo "\t\t\t\t\t\t\t\t\t<td class=\"ai1ec-col-xs-3\">\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<select class=\"select2 ai1ec-select2\"
\t\t\t\t\t\t\t\t\t\t\t\tname=\"ticket_type_";
                        // line 115
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "ticket_type_id"), "html", null, true);
                        echo "\">
\t\t\t\t\t\t\t\t\t\t";
                        // line 116
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable(range($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "buy_min_limit"), $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "buy_max_available")));
                        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                            // line 117
                            echo "\t\t\t\t\t\t\t\t\t\t\t<option ";
                            if (((isset($context["i"]) ? $context["i"] : null) == 1)) {
                                echo "selected";
                            }
                            echo ">";
                            echo twig_escape_filter($this->env, (isset($context["i"]) ? $context["i"] : null), "html", null, true);
                            echo "</option>
\t\t\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 119
                        echo "\t\t\t\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t\t\t\t</td>\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t<td class=\"ai1ec-tickets-info ai1ec-col-xs-9 ai1ec-tickets-info-inactive\">
\t\t\t\t\t\t\t\t";
                    } else {
                        // line 122
                        echo "\t\t\t\t\t
\t\t\t\t\t\t\t\t\t<td class=\"ai1ec-tickets-info ai1ec-col-xs-12\">\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t";
                    }
                    // line 124
                    echo "\t\t
\t\t\t\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t\t\t\t";
                    // line 126
                    if (($this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "availability") != null)) {
                        // line 127
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t";
                        echo $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "availability");
                        echo "&nbsp; 
\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 128
                    echo "\t\t\t
\t\t\t\t\t\t\t\t\t\t\t<b>\$";
                    // line 129
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "ticket_price"), "html", null, true);
                    echo "</b>&nbsp;";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "ticket_name"), "html", null, true);
                    echo "
\t\t\t\t\t\t\t\t\t\t</div>\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t<div>";
                    // line 131
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ticket"]) ? $context["ticket"] : null), "description"), "html", null, true);
                    echo "</div>
\t\t\t\t\t\t\t\t\t</td>\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t";
                }
                // line 135
                echo "\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ticket'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 136
            echo "\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t\t<a href=\"#\" id=\"ai1ec_tickets_submit\"
\t\t\t\t\t   target=\"_blank\" class=\"ai1ec-btn ai1ec-btn-sm ai1ec-btn-primary\">
\t\t\t\t\t\t<i class=\"ai1ec-fa ai1ec-fa-ticket\"
\t\t\t\t\t       title=\"";
            // line 141
            echo twig_escape_filter($this->env, (isset($context["buy_tickets_text"]) ? $context["buy_tickets_text"] : null), "html_attr");
            echo "\"></i>
\t\t\t\t\t\t";
            // line 142
            echo twig_escape_filter($this->env, (isset($context["buy_tickets_text"]) ? $context["buy_tickets_text"] : null), "html", null, true);
            echo "
\t\t\t\t\t</a>
\t\t\t    </form>
\t\t\t</div>
\t\t</div>";
            // line 147
            echo "\t";
        }
        // line 148
        echo "
\t";
        // line 149
        if ((!twig_test_empty((isset($context["contact"]) ? $context["contact"] : null)))) {
            // line 150
            echo "\t\t<div class=\"ai1ec-contact ai1ec-row\">
\t\t\t<div class=\"ai1ec-field-label ";
            // line 151
            echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["text_contact"]) ? $context["text_contact"] : null), "html", null, true);
            echo "</div>
\t\t\t<div class=\"ai1ec-field-value ";
            // line 152
            echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
            echo "\">";
            echo (isset($context["contact"]) ? $context["contact"] : null);
            echo "</div>
\t\t</div>
\t";
        }
        // line 155
        echo "
\t";
        // line 156
        if ((!twig_test_empty((isset($context["categories"]) ? $context["categories"] : null)))) {
            // line 157
            echo "\t\t<div class=\"ai1ec-categories ai1ec-row\">
\t\t\t<div class=\"ai1ec-field-label ";
            // line 158
            echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
            echo " ai1ec-col-xs-1\">
\t\t\t\t<i class=\"ai1ec-fa ai1ec-fa-folder-open ai1ec-tooltip-trigger\"
\t\t\t\t\ttitle=\"";
            // line 160
            echo twig_escape_filter($this->env, (isset($context["text_categories"]) ? $context["text_categories"] : null), "html_attr");
            echo "\"></i>
\t\t\t</div>
\t\t\t<div class=\"ai1ec-field-value ";
            // line 162
            echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
            echo " ai1ec-col-xs-10\">
\t\t\t\t";
            // line 163
            echo (isset($context["categories"]) ? $context["categories"] : null);
            echo "
\t\t\t</div>
\t\t</div>
\t";
        }
        // line 167
        echo "
\t";
        // line 168
        if ((!twig_test_empty((isset($context["tags"]) ? $context["tags"] : null)))) {
            // line 169
            echo "\t\t<div class=\"ai1ec-tags ai1ec-row\">
\t\t\t<div class=\"ai1ec-field-label ";
            // line 170
            echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
            echo " ai1ec-col-xs-1\">
\t\t\t\t<i class=\"ai1ec-fa ai1ec-fa-tags ai1ec-tooltip-trigger\"
\t\t\t\t\ttitle=\"";
            // line 172
            echo twig_escape_filter($this->env, (isset($context["text_tags"]) ? $context["text_tags"] : null), "html_attr");
            echo "\"></i>
\t\t\t</div>
\t\t\t<div class=\"ai1ec-field-value ";
            // line 174
            echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
            echo " ai1ec-col-xs-10\">
\t\t\t\t";
            // line 175
            echo (isset($context["tags"]) ? $context["tags"] : null);
            echo "
\t\t\t</div>
\t\t</div>
\t";
        }
        // line 179
        echo "\t
\t";
        // line 180
        if ((!twig_test_empty((isset($context["filter_groups"]) ? $context["filter_groups"] : null)))) {
            // line 181
            echo "\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["filter_groups"]) ? $context["filter_groups"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["filter_group"]) {
                // line 182
                echo "\t\t\t<div class=\"ai1ec-categories ai1ec-row\">
\t\t\t\t<div class=\"ai1ec-field-label ";
                // line 183
                echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
                echo " ai1ec-col-xs-1\">
\t\t\t\t\t<i class=\"ai1ec-fa ";
                // line 184
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["filter_group"]) ? $context["filter_group"] : null), "icon_name"), "html", null, true);
                echo " ai1ec-tooltip-trigger\"
\t\t\t\t\t\ttitle=\"";
                // line 185
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["filter_group"]) ? $context["filter_group"] : null), "text"), "html_attr");
                echo "\"></i>
\t\t\t\t</div>\t\t
\t\t\t\t<div class=\"ai1ec-field-value ";
                // line 187
                echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
                echo " ai1ec-col-xs-10\">
\t\t\t\t\t";
                // line 188
                echo $this->getAttribute((isset($context["filter_group"]) ? $context["filter_group"] : null), "html_value");
                echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['filter_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 191
            echo "\t
\t";
        }
        // line 193
        echo "
\t";
        // line 194
        if ((!twig_test_empty((isset($context["filter_groups"]) ? $context["filter_groups"] : null)))) {
            // line 195
            echo "\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["filter_groups"]) ? $context["filter_groups"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["filter_group"]) {
                // line 196
                echo "\t\t\t<div class=\"ai1ec-categories ai1ec-row\">
\t\t\t\t<div class=\"ai1ec-field-label ";
                // line 197
                echo twig_escape_filter($this->env, (isset($context["col1"]) ? $context["col1"] : null), "html", null, true);
                echo " ai1ec-col-xs-1\">
\t\t\t\t\t<i class=\"ai1ec-fa ";
                // line 198
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["filter_group"]) ? $context["filter_group"] : null), "icon_name"), "html", null, true);
                echo " ai1ec-tooltip-trigger\"
\t\t\t\t\t\ttitle=\"";
                // line 199
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["filter_group"]) ? $context["filter_group"] : null), "text"), "html_attr");
                echo "\"></i>
\t\t\t\t</div>
\t\t\t\t<div class=\"ai1ec-field-value ";
                // line 201
                echo twig_escape_filter($this->env, (isset($context["col2"]) ? $context["col2"] : null), "html", null, true);
                echo " ai1ec-col-xs-10\">
\t\t\t\t\t";
                // line 202
                echo $this->getAttribute((isset($context["filter_group"]) ? $context["filter_group"] : null), "html_value");
                echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['filter_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 206
            echo "\t";
        }
        // line 207
        echo "
";
        // line 208
        if (twig_test_empty((isset($context["map"]) ? $context["map"] : null))) {
            // line 209
            echo "\t</div>";
        } else {
            // line 211
            echo "\t\t</div>";
            // line 212
            echo "\t</div>";
        }
        // line 214
        echo "
";
        // line 215
        if ((!twig_test_empty((isset($context["API_URL"]) ? $context["API_URL"] : null)))) {
            // line 216
            echo "<script>
\t( new Image() ).src = '";
            // line 217
            echo twig_escape_filter($this->env, (isset($context["API_URL"]) ? $context["API_URL"] : null), "html", null, true);
            echo "../img/1x1.gif?event_id=";
            echo twig_escape_filter($this->env, (isset($context["api_event_id"]) ? $context["api_event_id"] : null), "html", null, true);
            echo "&r=' + Math.random();
</script>
";
        }
        // line 220
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "event-single.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  573 => 220,  565 => 217,  562 => 216,  560 => 215,  557 => 214,  554 => 212,  552 => 211,  549 => 209,  547 => 208,  544 => 207,  541 => 206,  531 => 202,  527 => 201,  522 => 199,  518 => 198,  514 => 197,  511 => 196,  506 => 195,  504 => 194,  501 => 193,  497 => 191,  487 => 188,  483 => 187,  478 => 185,  474 => 184,  470 => 183,  467 => 182,  462 => 181,  460 => 180,  457 => 179,  450 => 175,  446 => 174,  441 => 172,  436 => 170,  433 => 169,  431 => 168,  428 => 167,  421 => 163,  417 => 162,  412 => 160,  407 => 158,  404 => 157,  402 => 156,  399 => 155,  391 => 152,  385 => 151,  382 => 150,  380 => 149,  377 => 148,  374 => 147,  367 => 142,  363 => 141,  356 => 136,  350 => 135,  343 => 131,  336 => 129,  333 => 128,  327 => 127,  325 => 126,  321 => 124,  316 => 122,  310 => 119,  297 => 117,  293 => 116,  289 => 115,  285 => 113,  283 => 112,  280 => 111,  277 => 110,  272 => 109,  270 => 108,  264 => 105,  260 => 104,  256 => 103,  251 => 101,  247 => 100,  244 => 99,  242 => 98,  239 => 97,  232 => 93,  228 => 92,  222 => 91,  219 => 90,  217 => 89,  214 => 88,  207 => 84,  203 => 83,  197 => 82,  194 => 81,  192 => 80,  186 => 77,  182 => 76,  179 => 75,  176 => 74,  169 => 72,  166 => 71,  164 => 70,  160 => 69,  156 => 68,  150 => 67,  146 => 65,  139 => 61,  135 => 59,  132 => 58,  129 => 57,  125 => 55,  122 => 54,  119 => 53,  117 => 52,  113 => 50,  107 => 48,  105 => 47,  101 => 45,  98 => 44,  95 => 38,  92 => 37,  85 => 33,  78 => 29,  71 => 26,  69 => 25,  62 => 21,  57 => 18,  52 => 15,  49 => 11,  46 => 10,  34 => 5,  30 => 4,  51 => 15,  41 => 11,  33 => 9,  26 => 3,  21 => 2,  47 => 14,  44 => 9,  37 => 7,  31 => 5,  29 => 4,  24 => 3,  22 => 2,  19 => 1,);
    }
}
