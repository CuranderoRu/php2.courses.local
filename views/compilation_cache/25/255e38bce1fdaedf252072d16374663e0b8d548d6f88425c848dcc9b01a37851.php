<?php

/* itempage.html */
class __TwigTemplate_e7dc81463200005bdfcfad227e25c3bcd72662b82c41a5ba7f8dfc5994bbf98b extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <title>Megashop</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/normalize.css\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/shop.css\">
</head>

<body>
    <div class=\"header\"><a href=\"index.php\">My shop</a></div>
    <div class=\"container\">
        <div>
            <div class=\"item_capture\">";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "getName", array(), "method"), "html", null, true);
        echo "</div>
            <img src=\"../img/";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "getImage", array(), "method"), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "getImage", array(), "method"), "html", null, true);
        echo "\">
            <div>";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "getDescription", array(), "method"), "html", null, true);
        echo "</div>
            <div class=\"item_price\">Цена: ";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "getPrice", array(), "method"), "html", null, true);
        echo "</div>
            <div class=\"comments\">
                <form action=\"?c=product&a=addcomment&id=";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "getId", array(), "method"), "html", null, true);
        echo "\" method=\"post\">
                    <p><b>Ваше имя:</b><br>
                        <input type=\"text\" name=\"author\" size=\"25\">
                    </p>
                    <p><b>Комментарий:</b><br>
                        <textarea name=\"comment\"></textarea>
                    </p>
                    <button type=\"submit\">Отправить</button>
                </form>
                <br>
                Комментарии покупателей:
                ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["comments"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 30
            echo "                    <div class=\"comment_section\">
                        <div class=\"comment_author\">";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "getCommentName", array(), "method"), "html", null, true);
            echo " wrote on ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "getCommentDate", array(), "method"), "html", null, true);
            echo "</div>
                        <div class=\"comment_content\">";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "getComment", array(), "method"), "html", null, true);
            echo "</div>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "
            </div>

        </div>
    </div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "itempage.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 35,  83 => 32,  77 => 31,  74 => 30,  70 => 29,  56 => 18,  51 => 16,  47 => 15,  41 => 14,  37 => 13,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "itempage.html", "D:\\OSPanel\\domains\\php2.courses.local\\views\\itempage.html");
    }
}
