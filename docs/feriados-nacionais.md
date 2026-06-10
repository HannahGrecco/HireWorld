# Feriados Nacionais

Exibe os feriados nacionais do ano corrente para um determinado país.

---

## Model — `PublicHoliday`

**Arquivo:** `app/Models/PublicHoliday.php`

Representa um feriado público vinculado a um país.

| Campo        | Tipo      | Descrição                              |
|--------------|-----------|----------------------------------------|
| `country_id` | FK        | Referência ao país                     |
| `name`       | string    | Nome do feriado                        |
| `date`       | date      | Data do feriado                        |
| `year`       | integer   | Ano do feriado                         |
| `is_fixed`   | boolean   | Se o feriado é em data fixa todo ano   |

**Relacionamento:** `belongsTo(Country::class)`

---

## Migration

**Arquivo:** `database/migrations/2026_05_03_185214_create_public_holidays_table.php`

Cria a tabela `public_holidays` com chave estrangeira `country_id` referenciando `countries`, com cascade on delete.

---

## Service — `HolidayService`

**Arquivo:** `app/Services/HolidayService.php`

**Método:** `getHolidays(Country $country): array`

Lógica:
1. Verifica se já existem feriados do ano corrente no banco para o país.
2. Se sim, retorna os dados do banco (evita chamada desnecessária à API).
3. Se não, faz requisição à API [Nager.Date](https://date.nager.at/api/v3/PublicHolidays/{year}/{iso_code}).
4. Persiste os feriados retornados na tabela `public_holidays`.
5. Retorna o array de feriados.

Em caso de falha na API, loga um warning e retorna `[]`.

---

## Controller — `CountryController`

**Arquivo:** `app/Http/Controllers/CountryController.php`

O método `show($id)` instancia o `HolidayService` e passa o resultado para a view:

```php
$service = new HolidayService();
$holidays = $service->getHolidays($country) ?? [];
```

A variável `$holidays` é enviada para a view via `compact`.

---

## View

**Arquivo:** `resources/views/countries/show.blade.php`

Renderiza a lista de feriados com `@forelse`:

```blade
@forelse($holidays as $holiday)
    <li>
        <span>{{ $holiday['name'] }}</span>
        <span>{{ Carbon::parse($holiday['date'])->format('d/m/Y') }}</span>
    </li>
@empty
    <li>Nenhum feriado encontrado para este país.</li>
@endforelse
```
