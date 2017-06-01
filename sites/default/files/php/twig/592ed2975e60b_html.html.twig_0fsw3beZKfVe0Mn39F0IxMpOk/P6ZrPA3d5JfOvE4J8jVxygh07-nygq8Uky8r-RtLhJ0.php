<?php

/* themes/custom/anchor/templates/layout/html.html.twig */
class __TwigTemplate_71c66ddc516d2f0d25ef44e95c4a2f8c8549923146e5a96019312daa6ef4ef5a extends Twig_Template
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
        $tags = array();
        $filters = array("raw" => 29, "safe_join" => 30, "t" => 64);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
                array('raw', 'safe_join', 't'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 26
        echo "<!DOCTYPE html>
<html";
        // line 27
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["html_attributes"]) ? $context["html_attributes"] : null), "html", null, true));
        echo ">
  <head>
    <head-placeholder token=\"";
        // line 29
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar((isset($context["placeholder_token"]) ? $context["placeholder_token"] : null)));
        echo "\">
    <title>";
        // line 30
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar($this->env->getExtension('drupal_core')->safeJoin($this->env, (isset($context["head_title"]) ? $context["head_title"] : null), " | ")));
        echo "</title>
    <link href=\"https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700\" rel=\"stylesheet\">
    <css-placeholder token=\"";
        // line 32
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar((isset($context["placeholder_token"]) ? $context["placeholder_token"] : null)));
        echo "\">
    <js-placeholder token=\"";
        // line 33
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar((isset($context["placeholder_token"]) ? $context["placeholder_token"] : null)));
        echo "\">
  </head>
  <body";
        // line 35
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true));
        echo ">
  <header>
    <a class=\"logo\" href=\"\"><img src=\"/themes/custom/anchor/images/anchor-logo.png\" alt=\"\"></a>
    <div class=\"logo-bg\"></div>
    <div class=\"header-wrap\">
      <nav>
        <ul>
          <li class=\"nav-home\"><a href=\"#\">Home</a></li>
          <li><a href=\"#\">Our Story</a></li>
          <li><a href=\"#\">Products</a></li>
          <li class=\"right\"><a href=\"#\">Prize draw</a></li>
          <li class=\"right\"><a href=\"#\">Our News</a></li>
        </ul>
      </nav>
      <ul class=\"social\">
        <li class=\"facebook\"><a href=\"\"></a></li>
        <li class=\"twitter\"><a href=\"\"></a></li>
        <li class=\"youtube\"><a href=\"\"></a></li>
      </ul>
    </div>
    <span class=\"mob-nav\">Menu</span>
  </header>
  <main>
    ";
        // line 62
        echo "  </main>
    <a href=\"#main-content\" class=\"visually-hidden focusable\">
      ";
        // line 64
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Skip to main content")));
        echo "
    </a>
    ";
        // line 66
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["page_top"]) ? $context["page_top"] : null), "html", null, true));
        echo "
    ";
        // line 67
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["page"]) ? $context["page"] : null), "html", null, true));
        echo "
    ";
        // line 68
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["page_bottom"]) ? $context["page_bottom"] : null), "html", null, true));
        echo "

  <footer>
    <img class=\"footer-top\" src=\"/themes/custom/anchor/images/footer-top.svg\" alt=\"\">
    <div class=\"footer-in\">
      <img src=\"/themes/custom/anchor/images/the-good-stuff.png\" alt=\"\" class=\"footer-good-stuff\">
      <div class=\"footer-content\">
        <p>Lorem ipsum door sit amet &copy;2017</p>
        <ul class=\"footer-nav\">
          <li><a href=\"\">Cookie Policy</a></li>
          <li><a href=\"\">Privacy Policy</a></li>
          <li><a href=\"\">Terms &amp; Conditions</a></li>
          <li><a href=\"\">FAQs</a></li>
          <li class=\"last\"><a href=\"\">Contact us</a></li>
        </ul>
        <ul class=\"social\">
        <li class=\"facebook\"><a href=\"\"></a></li>
        <li class=\"twitter\"><a href=\"\"></a></li>
        <li class=\"youtube\"><a href=\"\"></a></li>
        </ul>
      </div>
    </div>
  </footer>
  <?php if (strpos(\$_SERVER['REQUEST_URI'], \"faqs\") !== false){ ?>
  <script>\$(document).ready(function() {
    \$(\".accordion .accord-header\").click(function() {
      if(\$(this).next(\"div\").is(\":visible\")){
        \$(this).next(\"div\").slideUp(\"fast\");
        \$(this).removeClass(\"active\");
      } else {
        \$(\".accordion .accord-content\").slideUp(\"fast\");
        \$(this).next(\"div\").slideToggle(\"fast\");
        \$(this).addClass(\"active\").siblings().removeClass(\"active\");;
      }
    });
});</script>
   <?php } ?>
    <js-bottom-placeholder token=\"";
        // line 105
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar((isset($context["placeholder_token"]) ? $context["placeholder_token"] : null)));
        echo "\">
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/anchor/templates/layout/html.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 105,  112 => 68,  108 => 67,  104 => 66,  99 => 64,  95 => 62,  69 => 35,  64 => 33,  60 => 32,  55 => 30,  51 => 29,  46 => 27,  43 => 26,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for the basic structure of a single Drupal page.
 *
 * Variables:
 * - logged_in: A flag indicating if user is logged in.
 * - root_path: The root path of the current page (e.g., node, admin, user).
 * - node_type: The content type for the current node, if the page is a node.
 * - head_title: List of text elements that make up the head_title variable.
 *   May contain one or more of the following:
 *   - title: The title of the page.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site.
 * - page_top: Initial rendered markup. This should be printed before 'page'.
 * - page: The rendered page markup.
 * - page_bottom: Closing rendered markup. This variable should be printed after
 *   'page'.
 * - db_offline: A flag indicating if the database is offline.
 * - placeholder_token: The token for generating head, css, js and js-bottom
 *   placeholders.
 *
 * @see template_preprocess_html()
 */
#}
<!DOCTYPE html>
<html{{ html_attributes }}>
  <head>
    <head-placeholder token=\"{{ placeholder_token|raw }}\">
    <title>{{ head_title|safe_join(' | ') }}</title>
    <link href=\"https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700\" rel=\"stylesheet\">
    <css-placeholder token=\"{{ placeholder_token|raw }}\">
    <js-placeholder token=\"{{ placeholder_token|raw }}\">
  </head>
  <body{{ attributes }}>
  <header>
    <a class=\"logo\" href=\"\"><img src=\"/themes/custom/anchor/images/anchor-logo.png\" alt=\"\"></a>
    <div class=\"logo-bg\"></div>
    <div class=\"header-wrap\">
      <nav>
        <ul>
          <li class=\"nav-home\"><a href=\"#\">Home</a></li>
          <li><a href=\"#\">Our Story</a></li>
          <li><a href=\"#\">Products</a></li>
          <li class=\"right\"><a href=\"#\">Prize draw</a></li>
          <li class=\"right\"><a href=\"#\">Our News</a></li>
        </ul>
      </nav>
      <ul class=\"social\">
        <li class=\"facebook\"><a href=\"\"></a></li>
        <li class=\"twitter\"><a href=\"\"></a></li>
        <li class=\"youtube\"><a href=\"\"></a></li>
      </ul>
    </div>
    <span class=\"mob-nav\">Menu</span>
  </header>
  <main>
    {#
      Keyboard navigation/accessibility link to main content section in
      page.html.twig.
    #}
  </main>
    <a href=\"#main-content\" class=\"visually-hidden focusable\">
      {{ 'Skip to main content'|t }}
    </a>
    {{ page_top }}
    {{ page }}
    {{ page_bottom }}

  <footer>
    <img class=\"footer-top\" src=\"/themes/custom/anchor/images/footer-top.svg\" alt=\"\">
    <div class=\"footer-in\">
      <img src=\"/themes/custom/anchor/images/the-good-stuff.png\" alt=\"\" class=\"footer-good-stuff\">
      <div class=\"footer-content\">
        <p>Lorem ipsum door sit amet &copy;2017</p>
        <ul class=\"footer-nav\">
          <li><a href=\"\">Cookie Policy</a></li>
          <li><a href=\"\">Privacy Policy</a></li>
          <li><a href=\"\">Terms &amp; Conditions</a></li>
          <li><a href=\"\">FAQs</a></li>
          <li class=\"last\"><a href=\"\">Contact us</a></li>
        </ul>
        <ul class=\"social\">
        <li class=\"facebook\"><a href=\"\"></a></li>
        <li class=\"twitter\"><a href=\"\"></a></li>
        <li class=\"youtube\"><a href=\"\"></a></li>
        </ul>
      </div>
    </div>
  </footer>
  <?php if (strpos(\$_SERVER['REQUEST_URI'], \"faqs\") !== false){ ?>
  <script>\$(document).ready(function() {
    \$(\".accordion .accord-header\").click(function() {
      if(\$(this).next(\"div\").is(\":visible\")){
        \$(this).next(\"div\").slideUp(\"fast\");
        \$(this).removeClass(\"active\");
      } else {
        \$(\".accordion .accord-content\").slideUp(\"fast\");
        \$(this).next(\"div\").slideToggle(\"fast\");
        \$(this).addClass(\"active\").siblings().removeClass(\"active\");;
      }
    });
});</script>
   <?php } ?>
    <js-bottom-placeholder token=\"{{ placeholder_token|raw }}\">
  </body>
</html>
";
    }
}
