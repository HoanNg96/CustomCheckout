# CustomCheckout

1. Add 1 step in when checkout for customer to type delivery date and note
- delivery date is required
- admin can see and modify delivery date and note in backend (in order detail)

# Construction step
- create module (di Magento_Checkout)
- add delivery date & note column in quote & sales_order table in database

* FE:
- add new checkout step:
    + create js file in <your_module_dir>/view/frontend/web/js/view
    + create html file in <your_module_dir>/view/frontend/web/template
    + add new step to checkout page layout
- add controller to save form data to quote table
- add observer to save form data to sales_order table

* BE:
- add delivery info in order info (layout, templates, block)
- add form to edit delivery info (block)