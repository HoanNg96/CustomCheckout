# CustomCheckout

1. Add 1 step in when checkout for customer to type delivery date and note
- delivery date is required
- admin can see and modify delivery date and note in backend (in order detail)

# Construction step
1. create module (di Magento_Checkout)
2. add delivery date & note column in quote & sales_order table in database
    - db_schema.xml

* FE:
3. add new checkout step:
    - add js file in <your_module_dir>/view/frontend/web/js/view
    - add html file in <your_module_dir>/view/frontend/web/template
    - add new step to checkout page layout (checkout_index_index.xml)
- add controller to save form data to quote table
- add observer to save form data to sales_order table

* BE:
- add delivery info in order info (layout, templates, block)
- add form to edit delivery info (block)