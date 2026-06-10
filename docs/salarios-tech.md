# Salários de Mercado (Tech)

Exibe benchmarks salariais de desenvolvedores por país, com base em dados do Stack Overflow Developer Survey.

---

## Model — `TechSalary`

**Arquivo:** `app/Models/TechSalary.php`  
**Tabela:** `tech_salary`

| Campo               | Tipo    | Descrição                              |
|---------------------|---------|----------------------------------------|
| `country_id`        | FK      | Referência ao país                     |
| `country`           | string  | Nome do país (fallback textual)        |
| `dev_type`          | string  | Tipo de desenvolvedor                  |
| `salary_usd_yearly` | decimal | Salário anual em USD                   |
| `years_code`        | float   | Anos de experiência com código         |
| `work_exp`          | float   | Anos de experiência profissional       |
| `employment_type`   | string  | Tipo de contrato (full-time, etc.)     |
| `remote_work`       | string  | Modalidade (remoto, híbrido, presencial)|
| `ed_level`          | string  | Nível de escolaridade                  |
| `survey_year`       | integer | Ano da pesquisa                        |

**Relacionamento:** `belongsTo(Country::class)`

---

## Migration

**Arquivo:** `database/migrations/2026_05_20_202131_create_tech_salary.php`  
Renomeada em: `database/migrations/2026_05_29_182944_rename_tech_salary_to_tech_salaries.php`  
Coluna `country_id` adicionada em: `database/migrations/2026_06_01_000000_add_country_id_to_tech_salary_table.php`

---

## Service — `TechSalaryService`

**Arquivo:** `app/Services/TechSalaryService.php`

**Método:** `getForCountry(Country|string $country, int $year = null): ?array`

Lógica:
1. Aceita instância de `Country` ou nome em string.
2. Determina o ano mais recente disponível no banco para o país.
3. Utiliza cache com TTL de 6 meses para evitar queries repetidas (`Cache::remember`).
4. Filtra registros com `salary_usd_yearly > 0`.
5. Retorna array estruturado com:

| Chave            | Conteúdo                                      |
|------------------|-----------------------------------------------|
| `survey_year`    | Ano dos dados                                 |
| `total_responses`| Total de respondentes                         |
| `salary`         | Média, mediana, min e max geral               |
| `by_dev_type`    | Top 10 tipos de dev por salário médio         |
| `by_seniority`   | Junior (≤2 anos), Mid (3-5), Senior (>5)     |
| `by_employment`  | Agrupado por tipo de emprego                  |
| `by_remote`      | Agrupado por modalidade de trabalho           |
| `by_education`   | Agrupado por nível de escolaridade            |

---

## Controller — `CountryController`

**Arquivo:** `app/Http/Controllers/CountryController.php`

```php
$serviceTechSalary = new TechSalaryService();
$techSalaries = $serviceTechSalary->getForCountry($country) ?? [];
```

---

## View

**Arquivo:** `resources/views/countries/show.blade.php`

```blade
@if (is_array($techSalaries) && isset($techSalaries['salary']))
    <p>Media anual (USD): {{ $techSalaries['salary']['average'] }}</p>
    <p>Mediana anual (USD): {{ $techSalaries['salary']['median'] }}</p>
    <p>Min (USD): {{ $techSalaries['salary']['min'] }}</p>
    <p>Max (USD): {{ $techSalaries['salary']['max'] }}</p>
@else
    <p>Sem dados de salários para este país.</p>
@endif
```
