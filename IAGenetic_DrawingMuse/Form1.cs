using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using IAGenetic_DrawingMuse.Genetic;
using System.Threading;

namespace IAGenetic_DrawingMuse
{
    public partial class Form1 : Form
    {
        private GeneticNation geneticNation; // Our Drawing muse ;)
        private Bitmap imgGoal;

        public Form1()
        {
            InitializeComponent();

            InitializetListPictures();
        }

        private void buttonInitialization_Click(object sender, EventArgs e)
        {
            // Get user choice and show the picked picture
            GetUserChoice();
            
            // Initialize the genetic algorithm
            geneticNation = new GeneticNation(imgGoal);
            Draw();
            textBoxNbNations.Text = (geneticNation.GetNbPopulations() +1) + " nation(s)";

            logs.Clear();
            buttonEvolve.Enabled = true;
        }

        private void buttonEvolve_Click(object sender, EventArgs e)
        {
            logs.Clear();

            // Set user choices for the statics properties
            geneticNation.SetMaxGenerations(int.Parse(textBoxMaxGeneration.Text));
            geneticNation.SetMinFitnessPercentage(int.Parse(textBoxAcceptedError.Text));
            geneticNation.SetCrossoverPercentage(int.Parse(textBoxCrossover.Text));
            geneticNation.SetMutationPercentage(int.Parse(textBoxMutation.Text));

            // Be the inspirations with us
            Task.Factory.StartNew(() =>
            {
                // Launch circles of life
                geneticNation.Evolve(logs);
                
                // draw the result
                pictureBoxGenetic.Invoke(new Action(() =>
                    Draw()
                ));
            });
        }

        private void Draw()
        {
            pictureBoxGenetic.Image = geneticNation.GetBitmap();
        }

        private void InitializetListPictures()
        {
            listPictures.SelectedIndex = 3;

            GetUserChoice();
        }

        private void GetUserChoice()
        {
            switch (listPictures.SelectedIndex)
            {
                case 1:
                    imgGoal = new Bitmap(Properties.Resources.mario_pixelise);
                    break;
                case 2:
                    imgGoal = new Bitmap(Properties.Resources.landscape);
                    break;
                case 3:
                    imgGoal = new Bitmap(Properties.Resources.joconde);
                    break;
                case 4:
                    imgGoal = new Bitmap(Properties.Resources.mario);
                    break;
                default:
                    imgGoal = new Bitmap(Properties.Resources.france);
                    break;
            }
            pictureBoxGoal.Image = imgGoal;
        }

        private void textBoxMaxGeneration_KeyPress(object sender, KeyPressEventArgs e)
        {
            AcceptOnlyNumbers(e);
        }

        private void textBoxAcceptedError_KeyPress(object sender, KeyPressEventArgs e)
        {
            AcceptOnlyNumbers(e);
        }

        private void textBoxCrossover_KeyPress(object sender, KeyPressEventArgs e)
        {
            AcceptOnlyNumbers(e);
        }

        private void textBoxMutation_KeyPress(object sender, KeyPressEventArgs e)
        {
            AcceptOnlyNumbers(e);
        }

        private void AcceptOnlyNumbers(KeyPressEventArgs e)
        {
            int num = 0;
            e.Handled = !int.TryParse(e.KeyChar.ToString(), out num);
        }

    }
}
