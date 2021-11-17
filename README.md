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
    - add new step to checkout page layout
4. add controller to save form data to quote table
5. add observer to save form data to sales_order table

* BE:
6. add delivery info field to order info (layout, templates, block)
7. add form to edit & save delivery info (controller, block, layout, template)