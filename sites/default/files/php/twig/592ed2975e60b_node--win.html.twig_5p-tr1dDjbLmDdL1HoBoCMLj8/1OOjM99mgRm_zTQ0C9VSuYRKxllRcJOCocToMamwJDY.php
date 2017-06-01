<?php

/* themes/custom/anchor/templates/content/node--win.html.twig */
class __TwigTemplate_8aaf3011ebca4248824ccfe0a28c03f87b5034a5a7a0addfade778c7beb52de0 extends Twig_Template
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
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
                array(),
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

        // line 73
        echo "
    <section class=\"sub-header\">
      <div class=\"sub-header-inner\">
        <h1>";
        // line 76
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["node"]) ? $context["node"] : null), "label", array()), "html", null, true));
        echo "</h1>
        <a href=\"\">";
        // line 77
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["content"]) ? $context["content"] : null), "field_header_image", array()), "html", null, true));
        echo "</a>
      </div>
      <img src=\"/themes/custom/anchor/images/main-top-curve.png\" alt=\"\">
    </section>
    <section class=\"with-background main\">
      <div class=\"intro win-intro\">
        <p class=\"regular-font\">
        ";
        // line 84
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["content"]) ? $context["content"] : null), "field_page_intro_text", array()), "html", null, true));
        echo "
        </p>
        <div class=\"timer\">
          <p>You have  <span><span class=\"days\"></span> days </span>,  <span><span class=\"hours\"></span> hrs </span>,  <span><span class=\"minutes\"></span> minutes</span>, and <span><span class=\"seconds\"></span> seconds</span> left to enter!</p>
        </div>
      </div>
      <div id=\"clouds\">
        <div class=\"cloud x2\"></div>
        <div class=\"cloud x3\"></div>
        <div class=\"cloud x4\"></div>
      </div>
      <div class=\"form-outer\">
        <div class=\"form-wrap\">
        <p>";
        // line 97
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["content"]) ? $context["content"] : null), "field_form_intro_text", array()), "html", null, true));
        echo "</p>
        <iframe src=\"localhost/anchor/statics/index.php\"></iframe>
      </div>
      </div>
    </section>

  <div class=\"codes-fixed\"><a href=\"\">You can still use your good stuff hub codes here</a><span></span></div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/anchor/templates/content/node--win.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 97,  62 => 84,  52 => 77,  48 => 76,  43 => 73,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override to display a node.
 *
 * Available variables:
 * - node: The node entity with limited access to object properties and methods.
 *   Only method names starting with \"get\", \"has\", or \"is\" and a few common
 *   methods such as \"id\", \"label\", and \"bundle\" are available. For example:
 *   - node.getCreatedTime() will return the node creation timestamp.
 *   - node.hasField('field_example') returns TRUE if the node bundle includes
 *     field_example. (This does not indicate the presence of a value in this
 *     field.)
 *   - node.isPublished() will return whether the node is published or not.
 *   Calling other methods, such as node.delete(), will result in an exception.
 *   See \\Drupal\\node\\Entity\\Node for a full list of public properties and
 *   methods for the node object.
 * - label: The title of the node.
 * - content: All node items. Use {{ content }} to print them all,
 *   or print a subset such as {{ content.field_example }}. Use
 *   {{ content|without('field_example') }} to temporarily suppress the printing
 *   of a given child element.
 * - author_picture: The node author user entity, rendered using the \"compact\"
 *   view mode.
 * - metadata: Metadata for this node.
 * - date: Themed creation date field.
 * - author_name: Themed author name field.
 * - url: Direct URL of the current node.
 * - display_submitted: Whether submission information should be displayed.
 * - attributes: HTML attributes for the containing element.
 *   The attributes.class element may contain one or more of the following
 *   classes:
 *   - node: The current template type (also known as a \"theming hook\").
 *   - node--type-[type]: The current node type. For example, if the node is an
 *     \"Article\" it would result in \"node--type-article\". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node--view-mode-[view_mode]: The View Mode of the node; for example, a
 *     teaser would result in: \"node--view-mode-teaser\", and
 *     full: \"node--view-mode-full\".
 *   The following are controlled through the node publishing options.
 *   - node--promoted: Appears on nodes promoted to the front page.
 *   - node--sticky: Appears on nodes ordered above other non-sticky nodes in
 *     teaser listings.
 *   - node--unpublished: Appears on unpublished nodes visible only to site
 *     admins.
 * - title_attributes: Same as attributes, except applied to the main title
 *   tag that appears in the template.
 * - content_attributes: Same as attributes, except applied to the main
 *   content tag that appears in the template.
 * - author_attributes: Same as attributes, except applied to the author of
 *   the node tag that appears in the template.
 * - title_prefix: Additional output populated by modules, intended to be
 *   displayed in front of the main title tag that appears in the template.
 * - title_suffix: Additional output populated by modules, intended to be
 *   displayed after the main title tag that appears in the template.
 * - view_mode: View mode; for example, \"teaser\" or \"full\".
 * - teaser: Flag for the teaser state. Will be true if view_mode is 'teaser'.
 * - page: Flag for the full page state. Will be true if view_mode is 'full'.
 * - readmore: Flag for more state. Will be true if the teaser content of the
 *   node cannot hold the main body content.
 * - logged_in: Flag for authenticated user status. Will be true when the
 *   current user is a logged-in member.
 * - is_admin: Flag for admin user status. Will be true when the current user
 *   is an administrator.
 *
 * @see template_preprocess_node()
 *
 * @todo Remove the id attribute (or make it a class), because if that gets
 *   rendered twice on a page this is invalid CSS for example: two lists
 *   in different view modes.
 */
#}

    <section class=\"sub-header\">
      <div class=\"sub-header-inner\">
        <h1>{{node.label}}</h1>
        <a href=\"\">{{content.field_header_image}}</a>
      </div>
      <img src=\"/themes/custom/anchor/images/main-top-curve.png\" alt=\"\">
    </section>
    <section class=\"with-background main\">
      <div class=\"intro win-intro\">
        <p class=\"regular-font\">
        {{ content.field_page_intro_text }}
        </p>
        <div class=\"timer\">
          <p>You have  <span><span class=\"days\"></span> days </span>,  <span><span class=\"hours\"></span> hrs </span>,  <span><span class=\"minutes\"></span> minutes</span>, and <span><span class=\"seconds\"></span> seconds</span> left to enter!</p>
        </div>
      </div>
      <div id=\"clouds\">
        <div class=\"cloud x2\"></div>
        <div class=\"cloud x3\"></div>
        <div class=\"cloud x4\"></div>
      </div>
      <div class=\"form-outer\">
        <div class=\"form-wrap\">
        <p>{{ content.field_form_intro_text }}</p>
        <iframe src=\"localhost/anchor/statics/index.php\"></iframe>
      </div>
      </div>
    </section>

  <div class=\"codes-fixed\"><a href=\"\">You can still use your good stuff hub codes here</a><span></span></div>
";
    }
}
