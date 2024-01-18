table "accounts" {
  schema  = schema.cuckoo
  collate = "utf8mb4_unicode_ci"
  column "id" {
    null           = false
    type           = int
    auto_increment = true
  }
  column "uuid" {
    null = false
    type = varchar(36)
  }
  column "user_id" {
    null = false
    type = int
  }
  column "name" {
    null = false
    type = varchar(255)
  }
  column "secret_key" {
    null = false
    type = varchar(255)
  }
  column "url" {
    null = false
    type = varchar(255)
  }
  primary_key {
    columns = [column.id]
  }
  foreign_key "user_id_account_id" {
    columns     = [column.user_id]
    ref_columns = [table.users.column.id]
    on_update   = NO_ACTION
    on_delete   = NO_ACTION
  }
  index "uniq_uuid" {
    unique  = true
    columns = [column.uuid]
  }
  index "user_id_account_id" {
    columns = [column.user_id]
  }
}
table "users" {
  schema  = schema.cuckoo
  collate = "utf8mb4_unicode_ci"
  column "id" {
    null           = false
    type           = int
    auto_increment = true
  }
  column "uuid" {
    null = false
    type = varchar(36)
  }
  column "authentication_token" {
    null = true
    type = varchar(44)
  }
  column "wrapped_vault_key" {
    null = true
    type = varchar(56)
  }
  primary_key {
    columns = [column.id]
  }
  index "uniq_authentication_token" {
    unique  = true
    columns = [column.authentication_token]
  }
  index "uniq_uuid" {
    unique  = true
    columns = [column.uuid]
  }
}
schema "cuckoo" {
  charset = "utf8mb4"
  collate = "utf8mb4_0900_ai_ci"
}
