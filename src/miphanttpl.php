<?php
// Copyright (C) 2025-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: MIT

namespace miphanttpl;

class miphanttpl
{
    private array $naofecha = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr'];
    private array $atributosemvalor = ['async', 'autofocus', 'autoplay', 'checked', 'controls', 'default', 'defer', 'disabled', 'download', 'hidden', 'loop', 'multiple', 'muted', 'novalidate', 'open', 'readonly', 'required', 'reversed', 'selected'];

    public function addNotClose(array $values)
    {
        $this->naofecha = array_merge($values, $this->naofecha);
    }

    public function addAttributeNoValue(array $values)
    {
        $this->atributosemvalor = array_merge($values, $this->atributosemvalor);
    }

    public function __call(string $element, mixed $arguments): string
    {
        /* Armazena o Conteúdo */
        $sArgumento = '';
        $sAtributos = '';

        foreach ($arguments as $conteudo) {
            /* Verifica se é um atributo */
            if (is_array($conteudo)) {
                foreach ($conteudo as $atributo => $valor) {
                    /* Verifica se o atributo não tem valor */
                    $sValor = (empty($atributo) || is_int($atributo)) ? $valor : $atributo;
                    if ($this->procurarValores($sValor, $this->atributosemvalor)) {
                        $sAtributos .= ' ' . $valor;
                    } else {
                        $sAtributos .= ' ' . $atributo . '="' . $valor . '"';
                    }
                }
            } else {
                $sArgumento .= $conteudo;
            }
        }

        /* Procura se o elemento não fecha */
        if ($this->procurarValores($element, $this->naofecha) !== false) {
            /* Retorna esse código caso o elemento não possa ser fechado */
            if ($element == 'img') {
                return '<' . $element . $sAtributos . ' />' . $sArgumento;
            } else {
                return '<' . $element . $sAtributos . '>' . $sArgumento;
            }
        } else {
            /* Retorna esse código caso o elemento possa ser fechado */
            return '<' . $element . $sAtributos . '>' . $sArgumento . '</' . $element . '>';
        }
    }

    public function code(mixed $callback)
    {
        return $callback($this);
    }

    /* Retorna o DOCTYPE HTML5 */
    public function doctype(): string
    {
        return '<!DOCTYPE html>' . "\n";
    }

    /* Procura os Valores do Array */
    private function procurarValores(string $palavra, mixed $itens): bool
    {
        $aItens = (is_array($itens)) ? $itens : [$itens];

        foreach ($aItens as $valor) {
            if (strpos($palavra, $valor, 0) !== false) {
                /* Retorna o primeiro resultado e encerra a procura */
                return true;
            }
        }

        return false;
    }
}
