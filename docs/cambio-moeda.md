# Câmbio e Moeda

Exibe a taxa de câmbio atual de 1 USD para a moeda local do país selecionado.

---

## Model — `Country`

**Arquivo:** `app/Models/Country.php`

O campo relevante para esta funcionalidade é:

| Campo           | Tipo   | Descrição                        |
|-----------------|--------|----------------------------------|
| `currency_code` | string | Código ISO da moeda (ex: BRL, EUR) |

---

## Migration

**Arquivo:** `database/migrations/2026_05_03_180051_create_countries_table.php`

A tabela `countries` contém o campo `currency_code` usado pelo `ExchangeRateService` para buscar a taxa correspondente.

---

## Service — `ExchangeRateService`

**Arquivo:** `app/Services/ExchangeRateService.php`

**Método:** `getRate(Country $country): float|null`

Lógica:
1. Faz requisição à API [Open Exchange Rates](https://openexchangerates.org/api/latest.json) usando a chave configurada em `config('app.open_exchange_rates_key')`.
2. Extrai a taxa correspondente ao `currency_code` do país.
3. Retorna o valor numérico da taxa (1 USD = X moeda local).

A chave da API **não é exposta** diretamente na URL — é lida via `config()` para evitar vazamento no código.

Em caso de falha na API, loga um warning e retorna `[]`.

---

## Controller — `CountryController`

**Arquivo:** `app/Http/Controllers/CountryController.php`

```php
$serviceRate = new ExchangeRateService();
$rates = $serviceRate->getRate($country) ?? [];
```

A variável `$rates` é enviada para a view via `compact`.

---

## View

**Arquivo:** `resources/views/countries/show.blade.php`

Exibido no card de informações do país:

```blade
<span class="font-medium text-slate-700">1 USD</span>
<p>{{ $rates }} {{ $country->currency_code }}</p>
```
