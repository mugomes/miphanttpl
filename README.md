# MiPhantTPL

> [!NOTE]
> This repository has been migrated to Codeberg, please see: https://codeberg.org/bluice/miphanttpl

**MiPhantTPL** é uma biblioteca PHP **leve, extensível e minimalista** para geração de HTML através de **métodos dinâmicos**, permitindo escrever HTML de forma **programática, fluente e sem templates externos**.

Cada método chamado representa uma **tag HTML**, funcionando como uma **DSL (Domain Specific Language)** para HTML em PHP.

---

## ✨ Características

- Geração dinâmica de HTML via `__call`
- Cada método representa uma *tag HTML*
- Suporte automático a:
  - Tags que não possuem fechamento (`img`, `br`, `input`, entre outros)
  - Atributos booleanos (`checked`, `disabled`, `required`, entre outros)
- Possibilidade de **estender tags auto-fecháveis**
- Possibilidade de **estender atributos sem valor**
- Paradigma funcional
- Zero dependências
- Código pequeno, previsível e fácil de integrar

---

## 📦 Instalação

### Via Composer

```bash
composer require bluiceoficial/miphanttpl
```

### Manual

Copie o arquivo `MiPhantTPL.php` para seu projeto e inclua via autoload ou `require`.

---

## 🚀 Uso básico

```php
use MiPhantTPL\MiPhantTPL;

$tpl = new MiPhantTPL();

echo $tpl->p('Olá mundo');
```

Resultado:

```html
<p>Olá mundo</p>
```

---

## 🧱 Criando elementos HTML

```php
echo $tpl->h1('Título');
echo $tpl->p('Conteúdo do parágrafo');
```

```html
<h1>Título</h1>
<p>Conteúdo do parágrafo</p>
```

---

## 🏷️ Atributos HTML

Os atributos são passados como **array**:

```php
echo $tpl->a(
    'Acessar site',
    ['href' => 'https://example.com', 'target' => '_blank']
);
```

```html
<a href="https://example.com" target="_blank">Acessar site</a>
```

---

## ✅ Atributos sem valor (booleanos)

A biblioteca reconhece automaticamente atributos booleanos:

```php
echo $tpl->input([
    'type' => 'checkbox',
    'checked'
]);
```

```html
<input type="checkbox" checked>
```

---

## ➕ Adicionando novos atributos sem valor

Você pode estender a lista padrão de atributos booleanos:

```php
$tpl->addAttributeNoValue(['inert', 'itemscope']);
```

```php
echo $tpl->div(
    'Conteúdo',
    ['inert']
);
```

```html
<div inert>Conteúdo</div>
```

---

## 🔁 Tags que não possuem fechamento

Tags como `img`, `br`, `input` e similares não recebem fechamento automaticamente:

```php
echo $tpl->img([
    'src' => 'foto.jpg',
    'alt' => 'Imagem'
]);
```

```html
<img src="foto.jpg" alt="Imagem" />
```

---

## ➕ Adicionando novas tags sem fechamento

Caso você utilize elementos personalizados (ex: Web Components):

```php
$tpl->addNotClose(['mycomponent']);
```

```php
echo $tpl->mycomponent([
    'data-id' => '123'
]);
```

```html
<mycomponent data-id="123">
```

---

## 🧩 HTML aninhado

Como tudo retorna `string`, é possível aninhar facilmente:

```php
echo $tpl->div(
    $tpl->h2('Título') .
    $tpl->p('Texto do conteúdo'),
    ['class' => 'container']
);
```

---

## ⚙️ Uso com paradigma funcional (`code()`)

O método `code()` permite escrever HTML de forma estruturada:

```php
echo $tpl->code(function ($html) {
    return
        $html->doctype() .
        $html->html(
            $html->body(
                $html->h1('MiPhantTPL') .
                $html->p('Gerando HTML com PHP puro')
            )
        );
});
```

---

## 📄 Doctype HTML5

```php
echo $tpl->doctype();
```

```html
<!DOCTYPE html>
```

---

## 👤 Autor

**Murilo Gomes Julio**

🔗 [https://www.bluice.com.br](https://www.bluice.com.br)

📺 [https://youtube.com/@bluiceoficial](https://youtube.com/@bluiceoficial)

---

## 📜 Licença

Copyright (c) 2025-2026 Murilo Gomes Julio

Licensed under the [MIT](https://github.com/bluiceoficial/miphanttpl/blob/main/LICENSE).

All contributions to the MiPhantTPL are subject to this license.
