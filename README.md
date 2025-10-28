# Inventory Management Starter (CodeIgniter + Vue)

This archive provides a starter structure for an Inventory Management System:
- `backend/` — CodeIgniter simplified starter files (controllers, models, SQL)
- `frontend/` — Vue 3 + Vite starter (basic product list + API calls)

## How to use

1. Backend:
   - Ideally create a fresh CodeIgniter 4 project: `composer create-project codeigniter4/appstarter backend`
   - Copy files from `backend/app` into your CI4 project `app/`.
   - Import `backend/inventory_schema.sql` into MySQL.
   - Configure `.env` in CI4 to point to the DB.

2. Frontend:
   - `cd frontend`
   - `npm install`
   - Adjust `src/api/axios.js` baseURL to match your backend.
   - `npm run dev`

This is a starter skeleton — expand with auth, validations, migrations, tests and production configuration.
