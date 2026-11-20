<?php

namespace app\models;

use DateTimeImmutable;

class Usuario
{
    private int $id_usuario;
    private string $nome;
    private string $email;
    private string $cpf;
    private string $telefone;
    private string $idade;
    private string $tipo_usuario;
    private string $foto;
    private string $senha;
    private DateTimeImmutable $criadoEm;

    public function __construct(int $id = 0, string $nome = '', ?string $email = null, ?string $cpf = null, ?
    string $telefone = null, ?string $idade = null, ?string $tipo_usuario = null, ?string $foto = null, ?string $senha = null){
        $this->id_usuario = $id;
        $this->nome = $nome;
        $this->email = $email ?? '';
        $this->cpf = $cpf ?? '';
        $this->telefone = $telefone ?? '';
        $this->idade = $idade ?? '';
        $this->tipo_usuario = $tipo_usuario ?? '';
        $this->foto = $foto ?? '';
        $this->senha = $senha ?? '';
        $this->criadoEm = new DateTimeImmutable();
    } 

    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario): self
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getIdade(): int
    {
        // O valor chega como texto do formulário; a validação garante que é um número de 18 a 120
        return (int) $this->idade;
    }

    public function setIdade(int $idade): self
    {
        $this->idade = $idade;

        return $this;
    }

    public function getTipoUsuario(): string
    {
        return $this->tipo_usuario;
    }

    public function setTipoUsuario(string $tipo_usuario): self
    {
        $this->tipo_usuario = $tipo_usuario;

        return $this;
    }

    public function getFoto(): string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getCriadoEm(): DateTimeImmutable
    {
        return $this->criadoEm;
    }

    public function setCriadoEm(DateTimeImmutable $criadoEm): self
    {
        $this->criadoEm = $criadoEm;

        return $this;
    }

    public static function arrayParaObjeto(array $usuario){

        return new self (
            $usuario['ID_Usuario'],
            $usuario['Nome'],
            $usuario['Email'],
            $usuario['CPF'],
            $usuario['Telefone'],
            $usuario['Idade'],
            $usuario['Tipo_usuario'],
            $usuario['Foto'],
            $usuario['Senha']
        );

    }
}