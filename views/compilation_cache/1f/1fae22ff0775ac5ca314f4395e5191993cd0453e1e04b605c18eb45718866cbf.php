<?php

/* books.html */
class __TwigTemplate_7dd59b5ef079a874723dbdf5173fbd58a1e1cb0c88f1d7cd8c32cbf73754f3e0 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html", "books.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo "Серия романов о Гарри Поттере";
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<h1>Серия романов о Гарри Поттере</h1>

<div id=\"books\">
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["books"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["book"]) {
            // line 8
            echo "    <div class=\"book\">
        <strong>";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "number", array()), "html", null, true);
            echo "</strong>. \"<em>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "title", array()), "html", null, true);
            echo "\"</em> - ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["book"], "date", array()), "html", null, true);
            echo "
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['book'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "books.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 12,  54 => 9,  51 => 8,  47 => 7,  42 => 4,  39 => 3,  33 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "books.html", "D:\\OSPanel\\domains\\php2.courses.local\\views\\books.html");
    }
}
