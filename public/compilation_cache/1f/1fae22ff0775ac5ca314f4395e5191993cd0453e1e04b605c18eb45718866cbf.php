<?php

/* books.html */
class __TwigTemplate_7dd59b5ef079a874723dbdf5173fbd58a1e1cb0c88f1d7cd8c32cbf73754f3e0 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"ru\">
<head>
    <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\"/>
</head>
<body>

<div id=\"content\">
    ";
        // line 10
        $this->displayBlock('content', $context, $blocks);
        // line 12
        echo "</div>

</body>
</html>";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "    ";
    }

    public function getTemplateName()
    {
        return "books.html";
    }

    public function getDebugInfo()
    {
        return array (  56 => 11,  53 => 10,  48 => 4,  41 => 12,  39 => 10,  30 => 4,  25 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "books.html", "D:\\OSPanel\\domains\\php2.courses.local\\views\\books.html");
    }
}
