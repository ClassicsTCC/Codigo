<?php 

namespace app\models;

use DateTimeImmutable;

class Empresa {

    private int $id_empresa;
    private string $nome;
    private ?string $email;
    private ?string $cnpj;
    private ?string $localizacao;
    private ?string $telefone;
    private ?string $senha;
    private ?string $status;
    private DateTimeImmutable $criadoEm;

    public function __construct(int $id = 0, string $nome = '', ?string $email = null, ?string $cnpj = null, ?string $localizacao = null, ?string $telefone = null, ?string $senha = null, ?string $status = null)
    {
        $this->id_empresa = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->cnpj = $cnpj;
        $this->localizacao = $localizacao;
        $this->telefone = $telefone;
        $this->senha = $senha;
        $this->status = $status;
        $this->criadoEm = new DateTimeImmutable();
    }  

    public function getIdEmpresa(): int
    {
        return $this->id_empresa;
    }

    public function setIdEmpresa(int $id_empresa): self
    {
        $this->id_empresa = $id_empresa;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getLocalizacao(): ?string
    {
        return $this->localizacao;
    }

    public function setLocalizacao(?string $localizacao): self
    {
        $this->localizacao = $localizacao;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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

        public static function arrayParaObjeto(array $empresa){

        return new self (
            $empresa['ID_Empresa'],
            $empresa['Name'],
            $empresa['Email'],
            $empresa['CNPJ'],
            $empresa['Localizacao'],
            $empresa['Telefone'],
            $empresa['Senha'],
            $empresa['Status']
        );

    }
}