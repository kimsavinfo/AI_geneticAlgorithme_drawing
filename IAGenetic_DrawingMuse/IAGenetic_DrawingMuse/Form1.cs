using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using System.Drawing.Imaging;
using IAGenetic_DrawingMuse.Genetic;
using System.Threading;

namespace IAGenetic_DrawingMuse
{
    public partial class Form1 : Form
    {
        private PopulationGenetic populationGenetic;
        private Bitmap imgGoal;
        private PopulationGoal populationGoal;
        private int iEvolvingCycles;

        public Form1()
        {
            InitializeComponent();

            InitializetListPictures();
        }

        private void buttonInitialization_Click(object sender, EventArgs e)
        {
            iEvolvingCycles = 0;
            GetUserChoice();
            populationGoal = new PopulationGoal(imgGoal);
            populationGenetic = new PopulationGenetic(populationGoal);
            Draw();

            logs.Clear();
            buttonEvolve.Enabled = true;
        }

        private void buttonEvolve_Click(object sender, EventArgs e)
        {
            populationGenetic.SetMaxGenerations(int.Parse(textBoxMaxGeneration.Text));
            populationGenetic.SetMinFitnessPercentage(int.Parse(textBoxAcceptedError.Text));
            populationGenetic.SetCrossoverPercentage(int.Parse(textBoxCrossover.Text));
            populationGenetic.SetMutationPercentage(int.Parse(textBoxMutation.Text));

            var task = Task.Factory.StartNew(() =>
            {
                populationGenetic.Evolve(populationGoal, logs);
        
                logs.Invoke(new Action(() =>
                    logs.AppendText(populationGenetic.GetLogs(iEvolvingCycles))
                ));
                logs.Invoke(new Action(() =>
                    logs.ScrollToCaret()
                ));

                this.Invoke(new Action(() =>
                    Draw()
                ));
            });

            iEvolvingCycles++;
        }

        private void Draw()
        {
            Bitmap imgGenetic = new Bitmap(populationGenetic.GetWitdh(), populationGenetic.GetHeight());
            IndividualColor[] individuals = populationGenetic.GetIndividuals();
            int iPixel = 0;
            int iLine, iColumn;
            foreach (IndividualColor pixel in individuals)
            {
                iLine = (int)Math.Floor((double)(iPixel / populationGenetic.GetWitdh()));
                iColumn = iPixel - iLine * populationGenetic.GetWitdh();
                imgGenetic.SetPixel(iColumn, iLine, pixel.GetColor());

                iPixel++;
            }

            pictureBoxGenetic.Image = imgGenetic;
        }

        private void InitializetListPictures()
        {
            listPictures.SelectedIndex = 0;
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
