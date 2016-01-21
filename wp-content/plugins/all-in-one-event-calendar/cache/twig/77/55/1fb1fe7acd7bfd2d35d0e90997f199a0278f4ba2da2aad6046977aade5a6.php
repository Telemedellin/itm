<?php

/* setting/twig_cache.twig */
class __TwigTemplate_77551fb1fe7acd7bfd2d35d0e90997f199a0278f4ba2da2aad6046977aade5a6 extends Twig_Template
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
        echo "<div class=\"ai1ec-col-sm-12\">
\t<ul class=\"ai1ec-fa-ul\">
\t\t<li id=\"ai1ec-cache-scan-success\" class=\"ai1ec-text-success";
        // line 3
        if (((isset($context["cache_available"]) ? $context["cache_available"] : null) == false)) {
            echo " ai1ec-hide";
        }
        echo "\">
\t\t\t<i class=\"ai1ec-fa ai1ec-fa-li ai1ec-fa-check-circle\"></i>
\t\t\t";
        // line 5
        echo $this->getAttribute((isset($context["text"]) ? $context["text"] : null), "okcache");
        echo "
\t\t</li>
\t\t<li id=\"ai1ec-cache-scan-danger\" class=\"ai1ec-text-danger";
        // line 7
        if (((isset($context["cache_available"]) ? $context["cache_available"] : null) == true)) {
            echo " ai1ec-hide";
        }
        echo "\">
\t\t\t<i class=\"ai1ec-fa ai1ec-fa-li ai1ec-fa-times-circle\"></i>
\t\t\t";
        // line 9
        echo $this->getAttribute((isset($context["text"]) ? $context["text"] : null), "nocache");
        echo "
\t\t\t<button class=\"ai1ec-btn ai1ec-btn-default ai1ec-btn-xs\" id=\"ai1ec-button-refresh\"
\t\t\t\tdata-loading-text=\"&lt;i class=&quot;ai1ec-fa ai1ec-fa-fw ai1ec-fa-refresh ai1ec-fa-spin&quot;&gt;&lt;/i&gt; ";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["text"]) ? $context["text"] : null), "rescan"), "html", null, true);
        echo "\">
\t\t\t\t<i class=\"ai1ec-fa ai1ec-fa-fw ai1ec-fa-refresh\"></i>
\t\t\t\t";
        // line 13
        echo $this->getAttribute((isset($context["text"]) ? $context["text"] : null), "refresh");
        echo "
\t\t\t</button>
\t\t</li>
\t</ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "setting/twig_cache.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 9,  80 => 14,  74 => 13,  55 => 8,  35 => 7,  21 => 1,  68 => 21,  66 => 11,  62 => 18,  59 => 9,  50 => 13,  44 => 5,  39 => 9,  30 => 5,  137 => 38,  133 => 37,  127 => 34,  123 => 33,  114 => 30,  110 => 29,  102 => 28,  96 => 27,  91 => 25,  87 => 24,  79 => 23,  73 => 22,  63 => 10,  57 => 15,  37 => 9,  29 => 7,  129 => 53,  119 => 32,  115 => 48,  108 => 44,  104 => 43,  97 => 39,  93 => 38,  86 => 34,  82 => 33,  75 => 29,  71 => 27,  67 => 19,  60 => 22,  48 => 19,  33 => 8,  22 => 2,  24 => 2,  19 => 1,  51 => 7,  47 => 11,  41 => 4,  36 => 8,  32 => 6,  27 => 3,  23 => 3,  20 => 1,  56 => 21,  52 => 13,  46 => 12,  43 => 9,  40 => 14,  38 => 3,  34 => 4,  31 => 3,  28 => 2,);
    }
}
